<?php

namespace App\Http\Controllers\Product;

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
use Maatwebsite\Excel\Concerns\ToArray;
use PhpParser\Node\Expr\Cast\Object_;

class ProductController extends Controller
{
    use ResponseController;

    protected FlashSaleRepositoryInterface $flashSaleRepository;
    protected CategoryRepositoryInterface $repositoryCategory;
    protected AttributeRepositoryInterface $repositoryAttribute;
    protected DiscountRepositoryInterface $discountRepository;

    public function __construct(
        ProductRepositoryInterface   $repository,
        FlashSaleRepositoryInterface $flashSaleRepository,
        DiscountRepositoryInterface  $discountRepository,
        CategoryRepositoryInterface  $repositoryCategory,
        AttributeRepositoryInterface $repositoryAttribute,
        ProductServiceInterface      $service
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->flashSaleRepository = $flashSaleRepository;
        $this->repositoryCategory = $repositoryCategory;
        $this->repositoryAttribute = $repositoryAttribute;
        $this->discountRepository = $discountRepository;
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
        return view($this->view['indexUser']);
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
        // dd($product->on_flash_sale);
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
        // params: flash_sale_id
        $flash_sale_id = 2;
        $flashSaleProduct_Rows = $this->flashSaleRepository->getAllFlashSaleProducts_Rows($flash_sale_id);
        $flashSaleProducts = [];
        $on_flash_sale = false;

        foreach ($flashSaleProduct_Rows as $item) {
            $on_flash_sale = true;
            // Get All Flash Sale Products
            $product = $this->repository->loadRelations($this->repository->findOrFail($item->product_id), [
                'categories:id,name',
                'productAttributes' => function ($query) {
                    return $query->with(['attribute.variations', 'attributeVariations:id']);
                },
                'productVariations.attributeVariations'
            ]);
            $product = new ProductEditResource($product);
            $products = (object)[
                'product' => $product,
                'in_stock' => $item->qty,
                'sold' => $item->sold = $item->sold ? $item->sold : 0,
            ];
            array_push($flashSaleProducts, $products);
        }
        
        return view($this->view['sale-limited'], [
            'products' => $flashSaleProducts,
            'on_flash_sale' => $on_flash_sale,
        ]);
    }
}
