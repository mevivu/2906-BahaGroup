<?php

namespace App\Admin\Http\Controllers\ShoppingCart;

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
use App\Traits\ResponseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ShoppingCartController extends Controller
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
    )
    {
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
            'index' => 'user.cart.index',
            'payment' => 'user.cart.payment',
        ];
    }

    public function getRoute(): array
    {
        return [
            // 'index' => 'admin.product.index',
            // 'create' => 'admin.product.create',
            // 'edit' => 'admin.product.edit',
            // 'delete' => 'admin.product.delete'
        ];
    }

    public function index()
    {
        // $categories = $this->repositoryCategory->getFlatTree();
        // $categories = $categories->map(function ($category) {
        //     return [$category->id => generate_text_depth_tree($category->depth) . $category->name];
        // });
        return view($this->view['index']);
    }

    public function payment()
    {
        // $categories = $this->repositoryCategory->getFlatTree();
        // $categories = $categories->map(function ($category) {
        //     return [$category->id => generate_text_depth_tree($category->depth) . $category->name];
        // });
        return view($this->view['payment']);
    }
}
