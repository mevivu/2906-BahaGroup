<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Admin\Http\Resources\Product\ProductEditResource;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Api\V1\Http\Resources\Product\ProductVariationResource;
use App\Traits\ResponseController;
use Illuminate\Http\Request;

use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;

class ProductController extends Controller
{
    use ResponseController;

    protected CategoryRepositoryInterface $repositoryCategory;
    protected AttributeRepositoryInterface $repositoryAttribute;
    protected DiscountRepositoryInterface $discountRepository;
    protected SettingRepositoryInterface $settingRepository;

    public function __construct(
        ProductRepositoryInterface $repository,
        DiscountRepositoryInterface $discountRepository,
        CategoryRepositoryInterface $repositoryCategory,
        AttributeRepositoryInterface $repositoryAttribute,
        SettingRepositoryInterface $settingRepository,
        ProductServiceInterface $service
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->repositoryCategory = $repositoryCategory;
        $this->repositoryAttribute = $repositoryAttribute;
        $this->discountRepository = $discountRepository;
        $this->settingRepository = $settingRepository;
        $this->service = $service;
    }

    public function getView(): array
    {
        return [
            'indexUser' => 'user.products.index',
            'sale-limited' => 'user.products.sale-limited',
            'product-detail' => 'user.products.product-detail',
        ];
    }

    public function getRoute(): array
    {
        return [
        ];
    }

    public function indexUser()
    {
        // $categories = $this->repositoryCategory->getFlatTree();
        // $categories = $categories->map(function ($category) {
        //     return [$category->id => generate_text_depth_tree($category->depth) . $category->name];
        // });

        $settingsGeneral = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settingsGeneral->where('setting_key', 'product_title')->first()->plain_value;
        $meta_desc = $settingsGeneral->where('setting_key', 'product_meta_desc')->first()->plain_value;
        return view($this->view['indexUser'], compact('title', 'meta_desc'));
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
        return view($this->view['product-detail'], [
            'product' => $product,
            'relatedProducts' => $randomProducts
        ]);
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
        return view($this->view['sale-limited'], compact('title', 'meta_desc'));
    }
}
