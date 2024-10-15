<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Repositories\Attribute\AttributeRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Admin\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Admin\Traits\AuthService;
use App\Enums\Discount\DiscountType;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Setting\SettingGroup;
use App\Http\Requests\ShoppingCart\ApplyDiscountCodeRequest;
use App\Http\Requests\ShoppingCart\ChangeQtyRequest;
use App\Http\Requests\ShoppingCart\CheckoutRequest;
use App\Http\Requests\ShoppingCart\ShoppingCartRequest;
use App\Models\ShoppingCart;
use App\Traits\ResponseController;
use Illuminate\Http\Request;

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

    public function index()
    {
        $user = $this->getCurrentUser();
        $object = $this->settingRepository->getBy(['setting_key' => 'object_discount']);

        if ($user) {
            return view($this->view['index'], [
                'shoppingCart' => $user->shopping_cart,
                'total' => $this->service->calculageTotal($user),
                'discount_value' => 0,
                'object' => $object[0]->plain_value,
                'breadcrumbs' => $this->crums->add(__('Giỏ hàng'))->getBreadcrumbs()
            ]);
        } else {
            $cart = session()->get('cart', []);
            $shopping_cart = [];
            foreach ($cart as $item) {
                $shopping_cart[] = [
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'product_variation_id' => $item['product_variation_id'] ?? null,
                    'product' => $this->repository->find($item['product_id']),
                ];
            }
            return view($this->view['index'], [
                'shoppingCart' => $shopping_cart,
                'total' => $this->service->calculateTotalFromSession($cart),
                'discount_value' => 0,
                'object' => $object[0]->plain_value,
                'breadcrumbs' => $this->crums->add(__('Giỏ này'))->getBreadcrumbs()
            ]);
        }
    }


    public function checkout(Request $request)
    {
        $user = $this->getCurrentUser();

        if ($user) {
            $total = $this->service->calculageTotal($user);
            $discountValue = 0;

            if ($request->input('code')) {
                $discount = $this->discountRepository->findByField('code', $request->input('code'));

                if ($discount && $total > $discount->min_order_amount && $discount->max_usage > 0) {
                    $discountValue = $this->service->calculageDiscountValue($total, $discount);
                }
            }
            if ($request->query('cart_id')) {
                $cartItem = $user->shopping_cart->where('id', $request->query('cart_id'))->first();

                if ($cartItem) {

                    $total = $cartItem->price * $cartItem->quantity;

                    return view($this->view['payment'], [
                        'user' => $user,
                        'total' => $total,
                        'shoppingCart' => [$cartItem],
                        'discount_value' => $discountValue,
                        'payment_methods' => PaymentMethod::asSelectArray(),
                        'code' => $request->input('code') ?? null,
                        'breadcrumbs' =>  $this->crums->add(__('Giỏ hàng'), route('user.cart.index'))->add(__('Thanh toán'))->getBreadcrumbs()
                    ]);
                }
            }
            return view($this->view['payment'], [
                'user' => $user,
                'total' => $total,
                'shoppingCart' => $user->shopping_cart,
                'discount_value' => $discountValue,
                'payment_methods' => PaymentMethod::asSelectArray(),
                'code' => $request->input('code') ?? null,
                'breadcrumbs' =>  $this->crums->add(__('Giỏ hàng'), route('user.cart.index'))->add(__('Thanh toán'))->getBreadcrumbs()
            ]);
        }
        return view($this->view['payment'], [
            'shoppingCart' => [],
            'total' => 0,
            'discount_value' => 0,
            'payment_methods' => PaymentMethod::asSelectArray(),
            'code' => $request->input('code') ?? null,
            'breadcrumbs' =>  $this->crums->add(__('Giỏ hàng'), route('user.cart.index'))->add(__('Thanh toán'))->getBreadcrumbs()
        ]);
    }


    public function checkoutFinal(CheckoutRequest $request)
    {
        $result = $this->service->checkout($request);
        if ($result) {
            return to_route('user.index')->with('success', __('Đặt hàng thành công'));
        }
        return back()->with('error', __('Đặt hàng thất bại'));
    }

    public function store(ShoppingCartRequest $request)
    {
        $user = $this->getCurrentUser();

        if ($user !== null) {
            $result = $this->service->store($request);

            if ($result === 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Thêm sản phẩm thất bại, số lượng có thể mua đã đạt tối đa',
                ], 400);
            }

            return response()->json([
                'status' => true,
                'data' => [
                    'total' => $this->service->calculageTotal($user),
                    'count' => $user->shopping_cart()->sum('qty'),
                ]
            ]);
        } else {
            $result = $this->service->store($request);
            if ($result === 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Thêm sản phẩm thất bại, số lượng có thể mua đã đạt tối đa',
                ], 400);
            }
            return response()->json([
                'status' => true,
                'data' => [
                    'total' =>  $this->service->calculateTotalFromSession($result),
                    'count' => count($result),
                ]
            ]);
        }
    }



    public function buyNow(ShoppingCartRequest $request)
    {
        $user = $this->getCurrentUser();

        if ($user) {
            // Xử lý cho người dùng đã đăng nhập
            $result = $this->service->store($request);
            if ($result === 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Thêm sản phẩm thất bại, số lượng có thể mua đã đạt tối đa',
                ], 400);
            }
            return response()->json([
                'status' => true,
                'message' => 'Mua hàng thành công!',
                'data' => [
                    'id' => $result->id // Trả về ID của giỏ hàng hoặc order để frontend redirect
                ]
            ], 200);
        } else {
            // Lưu giỏ hàng vào localStorage cho khách vãng lai
            $cart = json_decode($request->input('cart'), true); // Lấy dữ liệu giỏ hàng từ frontend
            if (!$cart) {
                return response()->json([
                    'status' => false,
                    'message' => 'Giỏ hàng rỗng',
                ], 400);
            }

            // Xử lý logic mua ngay và trả về phản hồi cho frontend
            return response()->json([
                'status' => true,
                'message' => 'Mua hàng thành công!',
                'data' => [
                    'cart' => $cart
                ]
            ]);
        }
    }


    public function applyDiscountCode(ApplyDiscountCodeRequest $request)
    {
        $user = $this->getCurrentUser();
        $total = $this->service->calculageTotal($user);
        $discount = $this->discountRepository->findByField('code', $request->input('code'));
        if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
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
                'discount_value' => $this->service->calculageDiscountValue($total, $discount)
            ]
        ]);
    }

    public function increament(ChangeQtyRequest $request)
    {
        $result = $this->service->increament($request);
        if ($result) {
            $user = $this->getCurrentUser();
            $total = $this->service->calculageTotal($user);
            if ($request->input('code')) {
                $discount = $this->discountRepository->findByField('code', $request->input('code'));
                if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
                    return response()->json([
                        'status' => false,
                        'data' => [
                            'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
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
                        'discount_value' => $this->service->calculageDiscountValue($total, $discount)
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
            $total = $this->service->calculageTotal($user);
            if ($request->input('code')) {
                $discount = $this->discountRepository->findByField('code', $request->input('code'));
                if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
                    return response()->json([
                        'status' => false,
                        'data' => [
                            'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
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
                        'discount_value' => $this->service->calculageDiscountValue($total, $discount)
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
            $total = $this->service->calculageTotal($user);
            if ($request->input('code')) {
                $discount = $this->discountRepository->findByField('code', $request->input('code'));
                if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
                    return response()->json([
                        'status' => false,
                        'data' => [
                            'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
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
                        'discount_value' => $this->service->calculageDiscountValue($total, $discount)
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
                'data' => [
                    'message' => 'Cập nhật giỏ hàng thất bại.'
                ]
            ], 400);
        }
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);
        if ($result) {
            $user = $this->getCurrentUser();
            $total = $this->service->calculageTotal($user);
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
                'data' => [
                    'message' => 'Cập nhật giỏ hàng thất bại.'
                ]
            ], 400);
        }
    }
}
