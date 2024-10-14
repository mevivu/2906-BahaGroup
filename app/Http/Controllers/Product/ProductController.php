<?php

namespace App\Http\Controllers\Product;

use App;
use App\Admin\Http\Requests\Product\ProductRequest;
use App\Admin\Repositories\Review\ReviewRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Admin\Http\Resources\Product\ProductEditResource;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Repositories\FlashSale\FlashSaleRepositoryInterface;
use App\Api\V1\Http\Resources\Product\ProductVariationResource;
use App\Traits\ResponseController;
use Illuminate\Http\Request;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;
use App\Admin\Http\Requests\Review\ReviewRequest;
use App\Admin\Services\Review\ReviewServiceInterface;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Admin\Repositories\Order\OrderDetailRepositoryInterface;

class ProductController extends Controller
{
    use ResponseController;

    protected FlashSaleRepositoryInterface $flashSaleRepository;
    protected CategoryRepositoryInterface $repositoryCategory;
    protected AttributeRepositoryInterface $repositoryAttribute;
    protected DiscountRepositoryInterface $discountRepository;
    protected SettingRepositoryInterface $settingRepository;
    protected ReviewServiceInterface $reviewService;
    protected ReviewRepositoryInterface $reviewRepository;
    protected OrderRepositoryInterface $orderRepository;
    protected OrderDetailRepositoryInterface $orderDetailRepository;
    public function __construct(
        ProductRepositoryInterface $repository,
        FlashSaleRepositoryInterface $flashSaleRepository,
        DiscountRepositoryInterface $discountRepository,
        CategoryRepositoryInterface $repositoryCategory,
        AttributeRepositoryInterface $repositoryAttribute,
        SettingRepositoryInterface $settingRepository,
        ProductServiceInterface $service,
        ReviewServiceInterface $reviewService,
        ReviewRepositoryInterface $reviewRepository,
        OrderRepositoryInterface $orderRepository,
        OrderDetailRepositoryInterface $orderDetailRepository,
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->flashSaleRepository = $flashSaleRepository;
        $this->repositoryCategory = $repositoryCategory;
        $this->repositoryAttribute = $repositoryAttribute;
        $this->discountRepository = $discountRepository;
        $this->settingRepository = $settingRepository;
        $this->service = $service;
        $this->reviewService = $reviewService;
        $this->reviewRepository = $reviewRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function getView(): array
    {
        return [
            'indexUser' => 'user.products.index',
            'sale-limited' => 'user.products.sale-limited',
            'product-detail' => 'user.products.product-detail',
            'product-modal' => 'components.quickview',
        ];
    }

    public function getRoute(): array
    {
        return [
            'home' => 'user.index'
        ];
    }

    public function indexUser(Request $request)
    {
        $settingsGeneral = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settingsGeneral->where('setting_key', 'product_title')->first()->plain_value;
        $meta_desc = $settingsGeneral->where('setting_key', 'product_meta_desc')->first()->plain_value;
        $categories = $this->repositoryCategory->getFlatTree();
        $colors = $this->repositoryAttribute->findByField('slug', 'mau-sac');
        $sizes = $this->repositoryAttribute->findByField('slug', 'kich-thuoc');
        $minMax = $this->repository->getMinMaxPromotionPrices();

        $filter = [
            'min_product_price' => $request->input('min_product_price'),
            'max_product_price' => $request->input('max_product_price'),
            'category_id' => $request->input('category_ids'),
            'color_id' => $request->input('color_ids'),
            'size_id' => $request->input('size_ids'),
            'limit' => 8
        ];

        $products = $this->repository->getProductsWithRelations($filter, [], $request->input('sort'));
        return view($this->view['indexUser'], [
            'categories' => $categories,
            'colors' => $colors,
            'sort' => $request->input('sort') ?? null,
            'sizes' => $sizes,
            'minMax' => $minMax,
            'products' => $products,
            'title' => $title,
            'meta_desc' => $meta_desc,
            'breadcrumbs' => $this->crums->add(__('Sản phẩm'))->getBreadcrumbs(),
        ]);
    }

    public function detail($id)
    {
        $product = $this->repository->loadRelations($this->repository->findOrFail($id), [
            'categories:id,name',
            'productAttributes' => function ($query) {
                return $query->with(['attribute.variations', 'attributeVariations:id']);
            },
            'productVariations.attributeVariations'
        ]);
        $randomProducts = $this->repository->getRelatedProducts($product->id);
        $product = new ProductEditResource($product);
        $is_reviewed = false;
        $orderIds = $this->orderRepository->getQueryBuilder()
            ->where('status', App\Enums\Order\OrderStatus::Completed->value)
            ->where('user_id', auth()->id())
            ->where('is_reviewed', App\Enums\Order\OrderReview::NotReviewed->value)
            ->where('created_at', '>=', now()->subDays(14))
            ->pluck('id')->toArray();
        $orderDetailIds = $this->orderDetailRepository->getQueryBuilder()
            ->whereIn('order_id', $orderIds)
            ->where('product_id', $id)
            ->pluck('id')->toArray();
        $reviews = $this->reviewRepository->getQueryBuilder()
            ->whereIn('order_id', $orderIds)
            ->where('product_id', $id)
            ->get();
        if (count($orderIds) > 0 && $reviews->count() == 0 && count($orderDetailIds) > 0) {
            $is_reviewed = true;
        }
        return view($this->view['product-detail'], [
            'product' => $product,
            'breadcrumbs' => $this->crums->add(__('Sản phẩm'), route('user.product.indexUser'))->add(__('Chi tiết sản phẩm'))->getBreadcrumbs(),
            'relatedProducts' => $randomProducts,
            'is_reviewed' => $is_reviewed,
            'orderIds' => $orderIds,
        ]);
    }

    public function detailModal($id)
    {
        $product = $this->repository->loadRelations($this->repository->findOrFail($id), [
            'categories:id,name',
            'reviews:rating,content,product_id',
            'productAttributes' => function ($query) {
                return $query->with(['attribute.variations', 'attributeVariations:id']);
            },
            'productVariations.attributeVariations'
        ]);
        $product = new ProductEditResource($product);
        $avg_review_rate = 0;
        $sum_customer_review = count($product->reviews) ? count($product->reviews) : 0;
        foreach ($product->reviews as $review) {
            $avg_review_rate += $review->rating;
        }
        $avg_review_rate = $sum_customer_review != 0 ? $avg_review_rate /= $sum_customer_review : 0;
        return (object) [
            'product' => $product,
            'avgReviewRate' => $avg_review_rate,
            'sumCustomerReview' => $sum_customer_review,
            'on_flash_sale' => true,
        ];
    }

    public function findVariationByAttributeVariationIds(Request $request)
    {
        $id = $request->input('product_id');
        $attributeVariationIds = $request->input('attribute_variation_ids');
        $product = $this->repository->loadRelations($this->repository->findOrFail($id), [
            'productVariations.attributeVariations'
        ]);

        $matchingProductVariation = $product->productVariations->first(function ($productVariation) use ($attributeVariationIds) {
            $variationAttributeIds = $productVariation->attributeVariations->pluck('id')->toArray();
            return empty(array_diff($attributeVariationIds, $variationAttributeIds)) &&
                count($attributeVariationIds) === count($variationAttributeIds);
        });

        if ($matchingProductVariation) {
            return response()->json([
                'status' => true,
                'data' => new ProductVariationResource($matchingProductVariation)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => __('Không tìm thấy sản phẩm phù hợp.')
            ], 400);
        }
    }

    public function saleLimited()
    {
        $settingsGeneral = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settingsGeneral->where('setting_key', 'sale_title')->first()->plain_value;
        $meta_desc = $settingsGeneral->where('setting_key', 'sale_meta_desc')->first()->plain_value;
        $flashSale = $this->flashSaleRepository->getFlashSaleId_ValidDay();

        return view($this->view['sale-limited'], [
            'flashSale' => $flashSale,
            'title' => $title,
            'products' => $flashSale->details()->paginate(8),
            'meta_desc' => $meta_desc,
            'breadcrumbs' => $this->homeCrums->add(__('Khuyến mãi giới hạn'))->getBreadcrumbs(),
        ]);
    }

    public function renderModalProduct($id)
    {
        $product = $this->repository->findOrFail($id);
        return view($this->view['product-modal'], [
            'productModal' => $product,
        ]);
    }

    public function searchProduct(Request $request)
    {
        $data = $request->input('key');
        $products = $this->repository->searchAllLimit($data);
        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }

    public function review(ReviewRequest $request)
    {
        $instance = $this->reviewService->store($request);
        $orderDetailIds = $this->orderDetailRepository->getQueryBuilder()
            ->where('order_id', $request->order_id)
            ->pluck('id')->toArray();
        $reviews = $this->reviewRepository->getQueryBuilder()
            ->where('order_id', $request->order_id)
            ->pluck('id')->toArray();
        if (count($orderDetailIds) == 1) {
            $this->orderRepository->update($request->order_id, ['is_reviewed' => App\Enums\Order\OrderReview::Reviewed->value]);
        } else if (count($orderDetailIds) == count($reviews)) {
            $this->orderRepository->update($request->order_id, ['is_reviewed' => App\Enums\Order\OrderReview::Reviewed->value]);
        }
        if ($instance) {
            return back()->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'));
    }
}
