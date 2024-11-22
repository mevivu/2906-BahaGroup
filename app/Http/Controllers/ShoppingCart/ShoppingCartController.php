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
use App\Enums\Payment\PaymentMethod;
use App\Http\Requests\ShoppingCart\ApplyDiscountCodeRequest;
use App\Http\Requests\ShoppingCart\ChangeQtyRequest;
use App\Http\Requests\ShoppingCart\CheckoutRequest;
use App\Http\Requests\ShoppingCart\ShoppingCartRequest;
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
                'total' => $this->service->calculateTotal($user->shopping_cart),
                'object' => $object[0]->plain_value,
                'breadcrumbs' => $this->crums->add(__('Giỏ hàng'))->getBreadcrumbs()
            ]);
        } else {
            $cart = session()->get('cart', []);
            return view($this->view['index'], [
                'shoppingCart' => $cart,
                'total' => $this->service->calculateTotalFromSession($cart),
                'object' => $object[0]->plain_value,
                'breadcrumbs' => $this->crums->add(__('Giỏ hàng'))->getBreadcrumbs()
            ]);
        }
    }


    public function checkout(Request $request)
    {
        $user = $this->getCurrentUser();

        if ($user) {
            if ($user->shopping_cart->count() > 0) {
                if ($request->query('cart_id')) {
                    $cartItem = $user->shopping_cart->where('id', $request->query('cart_id'))->first();
                    if ($cartItem) {
                        $cartItem['qty'] = $request->input('qty');
                        $total = $this->service->calculateTotal($cartItem);
                        return view($this->view['payment'], [
                            'user' => $user,
                            'total' => $total,
                            'isBuyNow' => true,
                            'shoppingCart' => [$cartItem],
                            'payment_methods' => PaymentMethod::asSelectArray(),
                            'code' => $request->input('code') ?? null,
                            'breadcrumbs' =>  $this->crums->add(__('Giỏ hàng'), route('user.cart.index'))->add(__('Thanh toán'))->getBreadcrumbs()
                        ]);
                    }
                }
                $total = $this->service->calculateTotal($user->shopping_cart);
                return view($this->view['payment'], [
                    'user' => $user,
                    'total' => $total,
                    'isBuyNow' => false,
                    'shoppingCart' => $user->shopping_cart,
                    'payment_methods' => PaymentMethod::asSelectArray(),
                    'code' => $request->input('code') ?? null,
                    'breadcrumbs' =>  $this->crums->add(__('Giỏ hàng'), route('user.cart.index'))->add(__('Thanh toán'))->getBreadcrumbs()
                ]);
            } else {
                return back()->with('error', __('Giỏ hàng của bạn đang trống.'));
            }
        } else {
            $cart = session()->get('cart', []);
            $cartCollection = collect($cart)->map(function ($item) {
                return (object) $item;
            });
            if ($cartCollection->count() > 0) {
                if ($request->query('cart_id')) {
                    $cartItem = $cartCollection->firstWhere('id', $request->input('cart_id'));
                    if ($cartItem) {
                        $cartItem->qty = $request->input('qty');
                        $total = $this->service->calculateTotal($cartItem);
                        return view($this->view['payment'], [
                            'user' => $user,
                            'total' => $total,
                            'isBuyNow' => true,
                            'shoppingCart' => [$cartItem],
                            'payment_methods' => PaymentMethod::asSelectArray(),
                            'code' => $request->input('code') ?? null,
                            'breadcrumbs' =>  $this->crums->add(__('Giỏ hàng'), route('user.cart.index'))->add(__('Thanh toán'))->getBreadcrumbs()
                        ]);
                    }
                }
                $total = $this->service->calculateTotal($cartCollection);
                return view($this->view['payment'], [
                    'total' => $total,
                    'isBuyNow' => false,
                    'shoppingCart' => $cartCollection,
                    'payment_methods' => PaymentMethod::asSelectArray(),
                    'code' => $request->input('code') ?? null,
                    'breadcrumbs' =>  $this->crums->add(__('Giỏ hàng'), route('user.cart.index'))->add(__('Thanh toán'))->getBreadcrumbs()
                ]);
            } else {
                return back()->with('error', __('Giỏ hàng của bạn đang trống.'));
            }
        }
    }

    public function checkoutFinal(CheckoutRequest $request)
    {
        $order = $this->service->checkout($request);
        if ($order) {
            if ($order->payment_method == PaymentMethod::Online) {
                return view('user.home.create-payment-vnpay', [
                    'order' => $order,
                    'breadcrumbs' =>  $this->crums->add(__('Giỏ hàng'), route('user.cart.index'))->add(__('Thanh toán'))->getBreadcrumbs()
                ]);
            }
            if ($order->surcharge) {
                return to_route('user.getOrderDetailForCustomer', [
                    'code' => $order->code,
                ])->with('success', __('Đặt hàng thành công, số lượng sản phẩm vượt quá chương trình flash sale. Chúng tôi sẽ tiến hành phụ thu, hãy kiểm tra kĩ đơn hàng.'));
            }
            return to_route('user.getOrderDetailForCustomer', [
                'code' => $order->code,
            ])->with('success', __('Đặt hàng thành công, hãy kiểm tra thông tin đơn hàng của bạn.'));
        }
        return back()->with('error', __('Đặt hàng thất bại'));
    }

    public function handleVnpay(Request $request)
    {
        return $this->service->handleVnpay($request);
    }

    public function handleVnpayReturn(Request $request)
    {
        return $this->service->handleVnpayReturn($request);
    }

    public function store(ShoppingCartRequest $request)
    {
        $user = $this->getCurrentUser();
        if ($user) {
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
                    'total' => $this->service->calculateTotal($user->shopping_cart),
                    'count' => $user->shopping_cart()->sum('qty'),
                ]
            ]);
        } else {
            $result = $this->service->storeNotLogin($request);
            if ($result === 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Thêm sản phẩm thất bại, số lượng có thể mua đã đạt tối đa',
                ], 400);
            }
            $cart = session()->get('cart', []);
            $count = 0;
            foreach ($cart as $item) {
                $count += $item['qty'];
            }
            return response()->json([
                'status' => true,
                'data' => [
                    'count' => $count,
                ]
            ]);
        }
    }



    public function buyNow(ShoppingCartRequest $request)
    {
        $user = $this->getCurrentUser();

        if ($user) {
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
                    'id' => $result->id,
                    'qty' => $request->input('qty')
                ]
            ], 200);
        } else {
            $result = $this->service->storeNotLogin($request);
            if ($result === 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Thêm sản phẩm thất bại, số lượng có thể mua đã đạt tối đa',
                ], 400);
            }
            return response()->json([
                'status' => true,
                'data' => [
                    'id' => $result->id,
                    'qty' => $request->input('qty')
                ]
            ], 200);
        }
    }


    public function applyDiscountCode(ApplyDiscountCodeRequest $request)
    {
        $user = $this->getCurrentUser();
        if ($user) {
            if ($request->input('cart_id')) {
                $shoppingCart = $user->shopping_cart()->where('id', $request->input('cart_id'))->first();
                if ($shoppingCart) {
                    $shoppingCart['qty'] = $request->input('qty');
                    $total = $this->service->calculateTotal($shoppingCart);
                    $discount = $this->discountRepository->findByField('code', $request->input('code'));
                    if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
                        return response()->json([
                            'status' => false,
                            'data' => [
                                'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                                    . $total . ', giá trị đơn hàng đủ điều kiện: '
                                    . $discount->min_order_amount . '.',
                                'total' => $total,
                                'discount_value' => 0
                            ]
                        ], 400);
                    }
                    return response()->json([
                        'status' => true,
                        'data' => [
                            'total' => $total,
                            'discount_value' => $this->service->calculateDiscountValue($total, $discount)
                        ]
                    ]);
                }
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => 'Giỏ hàng không tồn tại!',
                    ]
                ], 400);
            } else {
                $total = $this->service->calculateTotal($user->shopping_cart);
                $discount = $this->discountRepository->findByField('code', $request->input('code'));
                if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
                    return response()->json([
                        'status' => false,
                        'data' => [
                            'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                                . $total . ', giá trị đơn hàng đủ điều kiện: '
                                . $discount->min_order_amount . '.',
                            'total' => $total,
                            'discount_value' => 0
                        ]
                    ], 400);
                }
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'discount_value' => $this->service->calculateDiscountValue($total, $discount)
                    ]
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            $cartCollection = collect($cart)->map(function ($item) {
                return (object) $item;
            });
            if ($request->input('cart_id')) {
                if ($cartCollection) {
                    $cartCollection = $cartCollection->firstWhere('id', $request->input('cart_id'));
                    $cartCollection->qty = $request->input('qty');
                    $total = $this->service->calculateTotal($cartCollection);
                    $discount = $this->discountRepository->findByField('code', $request->input('code'));
                    if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
                        return response()->json([
                            'status' => false,
                            'data' => [
                                'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                                    . $total . ', giá trị đơn hàng đủ điều kiện: '
                                    . $discount->min_order_amount . '.',
                                'total' => $total,
                                'discount_value' => 0
                            ]
                        ], 400);
                    }
                    return response()->json([
                        'status' => true,
                        'data' => [
                            'total' => $total,
                            'discount_value' => $this->service->calculateDiscountValue($total, $discount)
                        ]
                    ]);
                }
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => 'Giỏ hàng không tồn tại!',
                    ]
                ], 400);
            } else {
                $total = $this->service->calculateTotal($cartCollection);
                $discount = $this->discountRepository->findByField('code', $request->input('code'));
                if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
                    return response()->json([
                        'status' => false,
                        'data' => [
                            'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                                . $total . ', giá trị đơn hàng đủ điều kiện: '
                                . $discount->min_order_amount . '.',
                            'total' => $total,
                            'discount_value' => 0
                        ]
                    ], 400);
                }
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'discount_value' => $this->service->calculateDiscountValue($total, $discount)
                    ]
                ]);
            }
        }
    }

    public function increament(ChangeQtyRequest $request)
    {
        $result = $this->service->increament($request);
        if ($result === 1) {
            return response()->json([
                'status' => false,
                'message' => 'Số lượng có thể mua đã đạt tối đa.!'
            ], 400);
        }
        if ($result) {
            if ($this->getCurrentUser()) {
                $user = $this->getCurrentUser();
                $total = $this->service->calculateTotal($user->shopping_cart);
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                    ]
                ]);
            } else {
                $cart = session()->get('cart', []);
                $cartCollection = collect($cart)->map(function ($item) {
                    return (object) $item;
                });
                $total = $this->service->calculateTotal($cartCollection);
                $count = 0;
                foreach ($cart as $item) {
                    $count += $item['qty'];
                }
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $count,
                    ]
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'Tăng số lượng thất bại!'
        ], 400);
    }

    public function decreament(ChangeQtyRequest $request)
    {
        $result = $this->service->decreament($request);
        if ($result) {
            if ($this->getCurrentUser()) {
                $user = $this->getCurrentUser();
                $total = $this->service->calculateTotal($user->shopping_cart);
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                    ]
                ]);
            } else {
                $cart = session()->get('cart', []);
                $cartCollection = collect($cart)->map(function ($item) {
                    return (object) $item;
                });
                $total = $this->service->calculateTotal($cartCollection);
                $count = 0;
                foreach ($cart as $item) {
                    $count += $item['qty'];
                }
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $count,
                    ]
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Giảm số lượng thất bại!'
            ], 400);
        }
    }

    public function update(ChangeQtyRequest $request)
    {
        $result = $this->service->update($request);
        if ($result === 1) {
            return response()->json([
                'status' => false,
                'message' => 'Cập nhật giỏ hàng thất bại. Số lượng hàng còn lại không đủ!'
            ], 400);
        }
        if ($result) {
            if ($this->getCurrentUser()) {
                $user = $this->getCurrentUser();
                $total = $this->service->calculateTotal($user->shopping_cart);
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                    ]
                ]);
            } else {
                $cart = session()->get('cart', []);
                $cartCollection = collect($cart)->map(function ($item) {
                    return (object) $item;
                });
                $total = $this->service->calculateTotal($cartCollection);
                $count = 0;
                foreach ($cart as $item) {
                    $count += $item['qty'];
                }
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $count,
                    ]
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Cập nhật giỏ hàng thất bại.'
            ], 400);
        }
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);
        if ($result) {
            if ($this->getCurrentUser()) {
                $user = $this->getCurrentUser();
                $total = $this->service->calculateTotal($user->shopping_cart);
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $user->shopping_cart()->sum('qty'),
                    ]
                ]);
            } else {
                $cart = session()->get('cart', []);
                $cartCollection = collect($cart)->map(function ($item) {
                    return (object) $item;
                });
                $total = $this->service->calculateTotal($cartCollection);
                $count = 0;
                foreach ($cart as $item) {
                    $count += $item['qty'];
                }
                return response()->json([
                    'status' => true,
                    'data' => [
                        'total' => $total,
                        'count' => $count,
                    ]
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Cập nhật giỏ hàng thất bại.'
            ], 400);
        }
    }

    public function getCartItems()
    {
        $user = $this->getCurrentUser();
        if ($user) {
            $cart = $user->shopping_cart;
            if (isset($cart[0])) {
                foreach ($cart as $item) {
                    $price = isset($item['productVariation'])
                        ? $item['productVariation']['promotion_price']
                        : $item['product']['promotion_price'];

                    // Fetch attribute variations if a product variation exists
                    $attributes = isset($item['productVariation'])
                        ? $item['productVariation']['attributeVariations']->pluck('name')->toArray()
                        : []; // If no variation, no attributes

                    $cartItems[] = [
                        'id' => $item['id'],
                        'name' => $item['product']['name'],
                        'price' => $price,
                        'quantity' => $item['qty'],
                        'image' => asset($item['product']['avatar']),
                        'total_price' => $price * $item['qty'],
                        'attributes' => $attributes, // Add attributes here
                    ];
                }

                $cartTotal = array_reduce($cartItems, function ($carry, $item) {
                    return $carry + $item['total_price'];
                }, 0);

                return response()->json([
                    'cart_items' => $cartItems,
                    'cart_total' => $cartTotal,
                ]);
            }
            return response()->json([
                'cart_items' => [],
                'cart_total' => 0,
            ]);
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[0])) {
                foreach ($cart as $item) {
                    $price = isset($item['productVariation'])
                        ? $item['productVariation']['promotion_price']
                        : $item['product']['promotion_price'];

                    // Fetch attribute variations if a product variation exists
                    $attributes = isset($item['productVariation'])
                        ? $item['productVariation']['attributeVariations']->pluck('name')->toArray()
                        : []; // If no variation, no attributes

                    $cartItems[] = [
                        'id' => $item['id'],
                        'name' => $item['product']['name'],
                        'price' => $price,
                        'quantity' => $item['qty'],
                        'image' => asset($item['product']['avatar']),
                        'total_price' => $price * $item['qty'],
                        'attributes' => $attributes, // Add attributes here
                    ];
                }

                $cartTotal = array_reduce($cartItems, function ($carry, $item) {
                    return $carry + $item['total_price'];
                }, 0);

                return response()->json([
                    'cart_items' => $cartItems,
                    'cart_total' => $cartTotal,
                ]);
            }
            return response()->json([
                'cart_items' => [],
                'cart_total' => 0,
            ]);
        }
    }
}
