<?php

namespace App\Admin\Http\Controllers\ProductCategory;

use App\Admin\DataTables\ProductCategory\ProductCategoryDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Category\ProductCategoryRequest;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Services\Category\CategoryServiceInterface;
use App\Traits\ResponseController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Admin\DataTables\Product\ProductDataTable;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Enums\Category\HomeSliderOption;

class ProductCategoryController extends Controller
{
    use ResponseController;

    protected $productRepository;

    public function __construct(
        CategoryRepositoryInterface $repository,
        CategoryServiceInterface $service,
        ProductRepositoryInterface $productRepository,
    ) {

        parent::__construct();

        $this->repository = $repository;

        $this->service = $service;

        $this->productRepository = $productRepository;
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'edit' => 'admin.categories.edit',
            'product' => 'admin.categories.product',
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.category.index',
            'create' => 'admin.category.create',
            'edit' => 'admin.category.edit',
            'delete' => 'admin.category.delete',
            'product' => 'admin.category.product',
        ];
    }

    public function index(ProductCategoryDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'active' => [
                'Hoạt động' => 'Hoạt động',
                'Ẩn' => 'Ẩn'
            ]
        ]);
    }

    public function create(): Factory|View|Application
    {
        $categories = $this->repository->getFlatTree();
        return view($this->view['create'], [
            'categories' => $categories,
            'options' => HomeSliderOption::asSelectArray()
        ]);
    }

    public function store(ProductCategoryRequest $request): RedirectResponse
    {

        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['edit'], $response->id);
        }
        return back()->with('error', __('notifyFail'));
    }

    /**
     * @throws Exception
     */
    public function edit($id): Factory|View|Application
    {
        $categories = $this->repository->getFlatTreeNotInNode([$id]);
        $instance = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'category' => $instance,
                'categories' => $categories,
                'options' => HomeSliderOption::asSelectArray()
            ]
        );
    }

    public function product($id, ProductDataTable $dataTable)
    {
        $inStock = [1 => __('Còn hàng'), 0 => __('Hết hàng')];
        $isUserDiscount = [1 => __('Có'), 0 => __('Không')];

        $categories = $this->repository->getFlatTree();
        $categories = $categories->map(function ($category) {
            return [$category->id => generate_text_depth_tree($category->depth) . $category->name];
        });

        $category = $this->repository->findOrFail($id);

        $productIds = $this->productRepository->getQueryBuilderOrderBy()->whereHas('categories', function ($query) use ($id) {
            $query->where('categories.id', $id);
        })->get()->pluck('id')->toArray();

        if ($productIds) {
            $dataTable = new ProductDataTable($this->productRepository, $this->repository, $productIds);
        } else {
            $dataTable = new ProductDataTable($this->productRepository, $this->repository, [-1]);
        }

        return $dataTable->render($this->view['product'], [
            'in_stock' => $inStock,
            'is_user_discount' => $isUserDiscount,
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function update(ProductCategoryRequest $request): RedirectResponse
    {

        $response = $this->service->update($request);
        if ($response) {
            return to_route($this->route['index'])->with('success', __('notifySuccess'));
        }
        return to_route($this->route['index'])->with('error', __('notifyFail'));
    }

    public function delete($id): RedirectResponse
    {

        $response = $this->service->delete($id);
        if ($response) {
            return to_route($this->route['index'])->with('success', __('notifySuccess'));
        }
        return to_route($this->route['index'])->with('error', __('notifyFail'));
    }
}
