<?php

namespace App\Admin\Http\Controllers\ShoppingCart;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Http\Requests\ShoppingCart\ChangeQtyRequest;
use App\Admin\Http\Requests\ShoppingCart\ShoppingCartRequest;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Admin\Traits\AuthService;
use App\Traits\ResponseController;


class ShoppingCartController extends Controller
{
    use ResponseController, AuthService;

    protected CategoryRepositoryInterface $repositoryCategory;
    protected AttributeRepositoryInterface $repositoryAttribute;
    protected DiscountRepositoryInterface $discountRepository;

    public function __construct(
        ProductRepositoryInterface   $repository,
        DiscountRepositoryInterface  $discountRepository,
        CategoryRepositoryInterface  $repositoryCategory,
        AttributeRepositoryInterface $repositoryAttribute,
        ShoppingCartServiceInterface      $service
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

    public function calculageTotal($user)
    {
        $total = 0;
        $shoppingCart = $user->shopping_cart;
        foreach ($shoppingCart as $item) {
            $total += $item->product_variation_id
                ? ($item->product->on_flash_sale ? $item->productVariation->flash_sale_price * $item->qty : $item->productVariation->promotion_price * $item->qty)
                : ($item->product->on_flash_sale ? $item->product->flash_sale_price * $item->qty : $item->product->promotion_price * $item->qty);
        }
        return $total;
    }

    public function index()
    {
        $user = $this->getCurrentUser();
        if ($user) {
            return view($this->view['index'], [
                'shoppingCart' => $user->shopping_cart,
                'total' => $this->calculageTotal($user),
                'discount_value' => 555
            ]);
        }
        return view($this->view['index'], [
            'total' => 0,
            'shoppingCart' => [],
            'discount_value' => 555
        ]);
    }

    public function store(ShoppingCartRequest $request)
    {
        $result = $this->service->store($request);
        if ($result) {
            $user = $this->getCurrentUser();
            return response()->json([
                'status' => true,
                'data' => [
                    'total' => $this->calculageTotal($user),
                    'count' => $user->shopping_cart()->sum('qty'),
                    'discount_value' => 555
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 400);
        }
    }

    public function increament(ChangeQtyRequest $request)
    {
        $result = $this->service->increament($request);
        if ($result) {
            $user = $this->getCurrentUser();
            return response()->json([
                'status' => true,
                'data' => [
                    'total' => $this->calculageTotal($user),
                    'count' => $user->shopping_cart()->sum('qty'),
                    'discount_value' => 666
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 400);
        }
    }

    public function decreament(ChangeQtyRequest $request)
    {
        $result = $this->service->decreament($request);
        if ($result) {
            $user = $this->getCurrentUser();
            return response()->json([
                'status' => true,
                'data' => [
                    'total' => $this->calculageTotal($user),
                    'count' => $user->shopping_cart()->sum('qty'),
                    'discount_value' => 555
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 400);
        }
    }

    public function update(ChangeQtyRequest $request)
    {
        $result = $this->service->update($request);
        if ($result) {
            $user = $this->getCurrentUser();
            return response()->json([
                'status' => true,
                'data' => [
                    'total' => $this->calculageTotal($user),
                    'count' => $user->shopping_cart()->sum('qty'),
                    'discount_value' => 555
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 400);
        }
    }

    public function delete(ShoppingCartRequest $request)
    {
        $result = $this->service->delete($request);
        if ($result) {
            $user = $this->getCurrentUser();
            return response()->json([
                'status' => true,
                'data' => [
                    'total' => $this->calculageTotal($user),
                    'count' => $user->shopping_cart()->sum('qty'),
                    'discount_value' => 555
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 400);
        }
    }
}
