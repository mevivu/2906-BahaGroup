<?php

namespace App\Admin\Http\Controllers\Product;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Product\ProductRequest;
use App\Admin\Http\Resources\Product\ProductEditResource;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Services\Product\ProductServiceInterface;
use App\Admin\DataTables\Product\ProductDataTable;
use App\Enums\Product\ProductType;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Api\V1\Http\Resources\Product\ProductVariationResource;
use App\Traits\ResponseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    use ResponseController;

    protected CategoryRepositoryInterface $repositoryCategory;
    protected AttributeRepositoryInterface $repositoryAttribute;
    protected DiscountRepositoryInterface $discountRepository;

    public function __construct(
        ProductRepositoryInterface   $repository,
        DiscountRepositoryInterface  $discountRepository,
        CategoryRepositoryInterface  $repositoryCategory,
        AttributeRepositoryInterface $repositoryAttribute,
        ProductServiceInterface      $service
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->repositoryCategory = $repositoryCategory;
        $this->repositoryAttribute = $repositoryAttribute;
        $this->discountRepository = $discountRepository;
        $this->service = $service;
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'edit' => 'admin.products.edit',
            'search_render_list' => 'admin.orders.partials.list-search-result-product',
            'search_render_flash_sale' => 'admin.flash_sales.partials.list-search-result-product'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.product.index',
            'create' => 'admin.product.create',
            'edit' => 'admin.product.edit',
            'delete' => 'admin.product.delete'
        ];
    }

    public function index(ProductDataTable $dataTable)
    {
        $inStock = [1 => __('Còn hàng'), 0 => __('Hết hàng')];
        $isUserDiscount = [1 => __('Có'), 0 => __('Không')];
        $categories = $this->repositoryCategory->getFlatTree();
        $categories = $categories->map(function ($category) {
            return [$category->id => generate_text_depth_tree($category->depth) . $category->name];
        });
        return $dataTable->render($this->view['index'], [
            'in_stock' => $inStock,
            'is_user_discount' => $isUserDiscount,
            'categories' => $categories,
        ]);
    }

    public function create(): Factory|View|Application
    {
        $categories = $this->repositoryCategory->getFlatTree();
        $attributes = $this->repositoryAttribute->getAllPluckById();
        return view(
            $this->view['create'],
            [
                'type' => ProductType::asSelectArray(),
                'categories' => $categories,
                'attributes' => $attributes,
            ]
        );
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $response = $this->service->store($request);
        return $this->handleResponse($response, $request, $this->route['index'], $this->route['edit']);
    }

    /**
     * @throws \Exception
     */
    public function edit($id, Request $request): Factory|View|Application
    {

        $product = $this->repository->loadRelations($this->repository->findOrFail($id), [
            'categories:id',
            'productAttributes' => function ($query) {
                return $query->with(['attribute.variations', 'attributeVariations:id']);
            },
            'productVariations.attributeVariations'
        ]);
        $product = new ProductEditResource($product);
        $categories = $this->repositoryCategory->getFlatTree();
        $attributes = $this->repositoryAttribute->getAllPluckById();
        return view(
            $this->view['edit'],
            [
                'product' => (object)$product->toArray($request),
                'type' => ProductType::asSelectArray(),
                'categories' => $categories,
                'attributes' => $attributes,
            ]
        );
    }

    public function update(ProductRequest $request): RedirectResponse
    {
        $response = $this->service->update($request);
        return $this->handleUpdateResponse($response, $this->route['edit']);
    }

    public function delete($id): RedirectResponse
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }

    public function searchRenderProductAndVariationOrder(ProductRequest $request): Factory|View|Application
    {
        $products = $this->repository->getByColumnsWithRelationsLimit([
            'name' => $request->input('key')
        ]);
        return view($this->view['search_render_list'], compact('products'));
    }

    public function searchRenderProductFlashSale(ProductRequest $request): Factory|View|Application
    {
        $products = $this->repository->getAllByColumns([
            'name' => $request->input('key')
        ]);
        return view($this->view['search_render_flash_sale'], compact('products'));
    }
}
