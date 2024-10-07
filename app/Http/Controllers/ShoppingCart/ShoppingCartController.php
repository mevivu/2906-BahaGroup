<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Admin\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Admin\Traits\AuthService;
use App\Enums\Discount\DiscountType;
use App\Http\Requests\ShoppingCart\ApplyDiscountCodeRequest;
use App\Http\Requests\ShoppingCart\ChangeQtyRequest;
use App\Http\Requests\ShoppingCart\ShoppingCartRequest;
use App\Traits\ResponseController;


class ShoppingCartController extends Controller
{
    use ResponseController, AuthService;

    protected CategoryRepositoryInterface $repositoryCategory;
    protected AttributeRepositoryInterface $repositoryAttribute;
    protected DiscountRepositoryInterface $discountRepository;
    protected SettingRepositoryInterface $settingRepository;

    public function __construct(
        ProductRepositoryInterface   $repository,
        DiscountRepositoryInterface  $discountRepository,
        CategoryRepositoryInterface  $repositoryCategory,
        AttributeRepositoryInterface $repositoryAttribute,
        SettingRepositoryInterface $settingRepository,
        ShoppingCartServiceInterface      $service
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
            'index' => 'user.cart.index',
            'payment' => 'user.cart.payment',
        ];
    }

    public function getRoute(): array
    {
        return [];
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

    public function calculageDiscountValue($total, $discount)
    {
        $discountValue = 0;
        if ($discount->type == DiscountType::Percent) {
            if ($total >= $discount->min_order_amount) {
                $discountValue = $total * ($discount->discount_value / 100);
            } else {
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này',
                    ]
                ], 400);
            }
        } else {
            if ($total >= $discount->min_order_amount) {
                $discountValue =  $discount->discount_value;
            } else {
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này',
                    ]
                ], 400);
            }
        }
        return $discountValue;
    }

    public function index()
    {
        $user = $this->getCurrentUser();
        $object = $this->settingRepository->getBy(['setting_key' => 'object_discount']);
        if ($user) {
            return view($this->view['index'], [
                'shoppingCart' => $user->shopping_cart,
                'total' => $this->calculageTotal($user),
                'discount_value' => 0,
                'object' => $object[0]->plain_value
            ]);
        }
        return view($this->view['index'], [
            'total' => 0,
            'shoppingCart' => [],
            'discount_value' => 0
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
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 400);
        }
    }

    public function applyDiscountCode(ApplyDiscountCodeRequest $request)
    {
        $user = $this->getCurrentUser();
        $total = $this->calculageTotal($user);
        $discount = $this->discountRepository->findByField('code', $request->input('code'));
        if ($total < $discount->min_order_amount) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                        . $total . ', giá trị đơn hàng đủ điều kiện: '
                        . $discount->min_order_amount . '.',
                    'total' => $total,
                    'count' => $user->shopping_cart()->sum('qty'),
                    'discount_value' => 0
                ]
            ], 400);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'total' => $total,
                'count' => $user->shopping_cart()->sum('qty'),
                'discount_value' => $this->calculageDiscountValue($total, $discount)
            ]
        ]);
    }

    public function increament(ChangeQtyRequest $request)
    {
        $result = $this->service->increament($request);
        if ($result) {
            $user = $this->getCurrentUser();
            $total = $this->calculageTotal($user);
            if ($request->input('code')) {
                $discount = $this->discountRepository->findByField('code', $request->input('code'));
                if ($total < $discount->min_order_amount) {
                    return response()->json([
                        'status' => false,
                        'data' => [
                            'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                                . $total . ', giá trị đơn hàng đủ điều kiện: '
                                . $discount->min_order_amount . '.',
                            'total' => $total,
                            'count' => $user->shopping_cart()->sum('qty'),
                            'discount_value' => 0
                        ]
                    ], 400);
                }
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                        'discount_value' => $this->calculageDiscountValue($total, $discount)
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                        'discount_value' => 0
                    ]
                ]);
            }
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
            $total = $this->calculageTotal($user);
            if ($request->input('code')) {
                $discount = $this->discountRepository->findByField('code', $request->input('code'));
                if ($total < $discount->min_order_amount) {
                    return response()->json([
                        'status' => false,
                        'data' => [
                            'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                                . $total . ', giá trị đơn hàng đủ điều kiện: '
                                . $discount->min_order_amount . '.',
                            'total' => $total,
                            'count' => $user->shopping_cart()->sum('qty'),
                            'discount_value' => 0
                        ]
                    ], 400);
                }
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                        'discount_value' => $this->calculageDiscountValue($total, $discount)
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                        'discount_value' => 0
                    ]
                ]);
            }
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
            $total = $this->calculageTotal($user);
            if ($request->input('code')) {
                $discount = $this->discountRepository->findByField('code', $request->input('code'));
                if ($total < $discount->min_order_amount) {
                    return response()->json([
                        'status' => false,
                        'data' => [
                            'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                                . $total . ', giá trị đơn hàng đủ điều kiện: '
                                . $discount->min_order_amount . '.',
                            'total' => $total,
                            'count' => $user->shopping_cart()->sum('qty'),
                            'discount_value' => 0
                        ]
                    ], 400);
                }
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                        'discount_value' => $this->calculageDiscountValue($total, $discount)
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                        'discount_value' => 0
                    ]
                ]);
            }
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
            $total = $this->calculageTotal($user);
            return response()->json([
                'status' => true,
                'data' => [
                    'total' => $total,
                    'count' => $user->shopping_cart()->sum('qty'),
                    'discount_value' => 0
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 400);
        }
    }
}
