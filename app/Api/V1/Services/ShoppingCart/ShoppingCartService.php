<?php

namespace App\Api\V1\Services\ShoppingCart;

use App\Admin\Repositories\Discount\DiscountApplicationRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Repositories\Order\OrderDetailRepositoryInterface;
use App\Admin\Repositories\Transaction\TransactionRepositoryInterface;
use App\Admin\Traits\AuthService;
use App\Admin\Traits\Setup;
use App\Api\V1\Repositories\Order\OrderRepositoryInterface;
use App\Api\V1\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Api\V1\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use App\Api\V1\Repositories\Product\{ProductRepositoryInterface, ProductVariationRepositoryInterface};
use App\Enums\Discount\DiscountType;
use App\Enums\Order\OrderReview;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\PaymentStatus;
use App\Enums\Product\ProductType;
use App\Enums\Transaction\TransactionStatus;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShoppingCartService implements ShoppingCartServiceInterface
{
    use UseLog, AuthService, Setup;
    protected $data;
    protected $orderDetails;

    protected $repository;
    protected $orderRepository;
    protected $orderDetailRepository;
    protected $productRepository;
    protected $productVariationRepository;
    protected $discountRepository;
    protected $discountApplicationRepository;

    protected $transactionRepository;

    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        OrderRepositoryInterface $orderRepository,
        OrderDetailRepositoryInterface $orderDetailRepository,
        ProductRepositoryInterface $productRepository,
        ProductVariationRepositoryInterface $productVariationRepository,
        DiscountRepositoryInterface $discountRepository,
        DiscountApplicationRepositoryInterface $discountApplicationRepository,
        TransactionRepositoryInterface $transactionRepository,
    ) {
        $this->repository = $repository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->productRepository = $productRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->discountRepository = $discountRepository;
        $this->discountApplicationRepository = $discountApplicationRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function handleVnpay(Request $request)
    {
        DB::beginTransaction();
        try {
            $language = $request->get('language');
            $orderId = $request->get('order_id');
            $bankcode = $request->get('bankcode');

            $order = $this->orderRepository->find($orderId);
            $transactionData = [
                'vnp_Amount' => ($order->total - $order->discount_value) * 100,
                'vnp_BankCode' => $bankcode,
                'vnp_OrderInfo' => 'Thanh toan don hang #' . $order->code,
                'vnp_TmnCode' => env('VNP_TMNCODE'),
                'vnp_TxnRef' => $order->code,
                'expires_at' => now()->addMinutes(15),
            ];
            $items = $this->transactionRepository->getBy(['vnp_TxnRef' => $transactionData['vnp_TxnRef']]);
            foreach ($items as $item) {
                $item->delete();
            }

            $this->transactionRepository->create($transactionData);

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('api.v1.handleVnpayReturn');
            $vnp_HashSecret = env('VNP_HASHSECRET'); //Chuỗi bí mật
            $vnp_OrderType = 'billpayment';
            $vnp_Locale = $language;
            $vnp_BankCode = $bankcode;
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => env('VNP_TMNCODE'),
                "vnp_Amount" => $transactionData['vnp_Amount'],
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => request()->ip(),
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $transactionData['vnp_OrderInfo'],
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $transactionData['vnp_TxnRef']
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Khởi tạo thanh toán VNPAY thành công.',
                'redirect_url' => $vnp_Url,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Khởi tạo thanh toán VNPAY thất bại.',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    public function handleVnpayReturn(Request $request)
    {
        try {
            DB::beginTransaction();
            $inputData = $request->all();
            $transaction = $this->transactionRepository->findByField('vnp_TxnRef', $inputData['vnp_TxnRef']);
            $order = $this->orderRepository->findByField('code', $inputData['vnp_TxnRef']);
            if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
                if ($transaction && $transaction->vnp_Amount == $inputData['vnp_Amount'] && $transaction->expires_at > now() && $transaction->status == TransactionStatus::Pending->value) {
                    $transaction->update([
                        'status' => TransactionStatus::Success
                    ]);
                    $order->update([
                        'payment_status' => PaymentStatus::Paid
                    ]);
                    DB::commit();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Thanh toán thành công.'
                    ], 200);
                }
            }
            $transaction->update([
                'status' => TransactionStatus::Failed
            ]);
            DB::commit();
            return response()->json([
                'status' => 400,
                'message' => 'Thanh toán thất bại.'
            ], 400);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Error handling VNPAY return.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function calculateDiscountValue($total, $discount)
    {
        $discountValue = 0;
        if ($discount->type == DiscountType::Percent) {
            if ($total >= $discount->min_order_amount) {
                $discountValue = $total * ($discount->discount_value / 100);
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này',
                ], 400);
            }
        } else {
            if ($total >= $discount->min_order_amount) {
                $discountValue = $discount->discount_value;
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này',
                ], 400);
            }
        }
        return $discountValue;
    }

    public function checkout(Request $request)
    {
        $this->data = $request->validated();
        $user = $this->getCurrentUser();
        $discount = null;
        $surcharge = 0; // Tổng phụ phí
        $flashSaleAppliedQty = 0; // Số lượng được áp dụng flash sale
        $flashSaleExcessQty = 0; // Số lượng vượt quá chương trình flash sale
        $this->data['order']['status'] = OrderStatus::Pending->value;
        $this->data['order']['is_reviewed'] = OrderReview::NotReviewed->value;
        $this->data['order']['code'] = $this->createCodeOrder();
        DB::beginTransaction();
        try {
            if ($user) {
                $this->data['order']['user_id'] = $user->id;
                $shopping_cart = $this->repository->findManyById($this->data['id']);
                $this->data['order']['total'] = $this->calculateTotal($shopping_cart);
                $this->prepareData($shopping_cart);
                if (isset($this->data['discount_code'])) {
                    $discount = $this->discountRepository->findByField('code', $this->data['discount_code']);
                    $this->data['order']['discount_value'] = $this->calculateDiscountValue($this->data['order']['total'], $discount);
                }
                $order = $this->orderRepository->create($this->data['order']);
                if (isset($this->data['discount_code'])) {
                    $this->handleDiscount($order, $discount);
                }
                $this->storeOrderDetail($order->id, $this->orderDetails);
                foreach ($order->details as $detail) {
                    if ($detail->product->on_flash_sale) {
                        $flashSaleDetail = $detail->product->on_flash_sale->details()->firstWhere('product_id', $detail->product_id);
                        $remainFlashSaleQty = $flashSaleDetail->qty - $flashSaleDetail->sold;

                        if ($remainFlashSaleQty < $detail->qty) {

                            $excessQty = $detail->qty - $remainFlashSaleQty;
                            $surcharge += $excessQty * ($detail->product->promotion_price - $flashSaleDetail->price);

                            $flashSaleAppliedQty += $remainFlashSaleQty;
                            $flashSaleExcessQty += $excessQty;
                        } else {
                            $flashSaleAppliedQty += $detail->qty;
                        }
                    }
                }

                if ($surcharge > 0) {
                    $order->note = "Đơn hàng sẽ thu thêm phụ phí: " . format_price($surcharge) .
                        " do vượt quá số lượng còn lại của chương trình flash sale. " .
                        "Số lượng sản phẩm áp dụng flash sale: $flashSaleAppliedQty, " .
                        "số lượng sản phẩm không áp dụng flash sale: $flashSaleExcessQty.";
                    $order->save();
                }
                $shopping_cart->each(function ($item) {
                    $item->delete();
                });
                DB::commit();
                return $order;
            } else {
                $cart = session('cart', []);
                $shopping_cart = collect($cart)->map(function ($item) {
                    return (object) $item;
                });
                $shopping_cart = $shopping_cart->whereIn('id', $this->data['id'])->values()->all();
                $this->data['order']['total'] = $this->calculateTotal($shopping_cart);
                $this->prepareData($shopping_cart);
                if (isset($this->data['discount_code'])) {
                    $discount = $this->discountRepository->findByField('code', $this->data['discount_code']);
                    $this->data['order']['discount_value'] = $this->calculateDiscountValue($this->data['order']['total'], $discount);
                }
                $order = $this->orderRepository->create($this->data['order']);
                if (isset($this->data['discount_code'])) {
                    $this->handleDiscount($order, $discount);
                }
                $this->storeOrderDetail($order->id, $this->orderDetails);
                foreach ($order->details as $detail) {
                    if ($detail->product->on_flash_sale) {
                        $flashSaleDetail = $detail->product->on_flash_sale->details()->firstWhere('product_id', $detail->product_id);
                        $remainFlashSaleQty = $flashSaleDetail->qty - $flashSaleDetail->sold;

                        if ($remainFlashSaleQty < $detail->qty) {

                            $excessQty = $detail->qty - $remainFlashSaleQty;
                            $surcharge += $excessQty * ($detail->product->promotion_price - $flashSaleDetail->price);

                            $flashSaleAppliedQty += $remainFlashSaleQty;
                            $flashSaleExcessQty += $excessQty;
                        } else {
                            $flashSaleAppliedQty += $detail->qty;
                        }
                    }
                }

                if ($surcharge > 0) {
                    $order->note = "Đơn hàng sẽ thu thêm phụ phí: " . format_price($surcharge) .
                        " do vượt quá số lượng còn lại của chương trình flash sale. " .
                        "Số lượng sản phẩm áp dụng flash sale: $flashSaleAppliedQty, " .
                        "số lượng sản phẩm không áp dụng flash sale: $flashSaleExcessQty.";
                    $order->save();
                }

                $updatedCart = array_filter($cart, function ($item) use ($shopping_cart) {
                    return !in_array($item['id'], array_column($shopping_cart, 'id'));
                });

                DB::commit();
                return [$order, $updatedCart];
            }
        } catch (Exception $e) {
            $this->logError('Failed to process checkout: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function calculateTotal($shoppingCart)
    {
        $total = 0;

        if (is_array($shoppingCart) || $shoppingCart instanceof \Traversable) {
            foreach ($shoppingCart as $item) {
                $total += $this->calculateItemTotal($item);
            }
        } else {
            $total += $this->calculateItemTotal($shoppingCart);
        }

        return $total;
    }

    private function calculateItemTotal($item)
    {
        if ($this->getCurrentUser()) {
            return $item->product_variation_id
                ? ($item->product->on_flash_sale ? $item->productVariation->flashsale_price * $item->qty : $item->productVariation->promotion_price * $item->qty)
                : ($item->product->on_flash_sale ? $item->product->flashsale_price * $item->qty : $item->product->promotion_price * $item->qty);
        } else {
            $product = $this->productRepository->findOrFail($item->product_id);
            if (!$product->isSimple()) {
                $productVariation = $this->productVariationRepository->findByProductAndAttributeVariation($item->product_id, $item->variation_id);
            }
            return $item->variation_id
                ? ($product->on_flash_sale ? $productVariation->flashsale_price * $item->qty : $productVariation->promotion_price * $item->qty)
                : ($product->on_flash_sale ? $product->flashsale_price * $item->qty : $product->promotion_price * $item->qty);
        }
    }

    private function handleDiscount($order, $discount)
    {
        $this->discountApplicationRepository->create([
            'discount_code_id' => $discount->id,
            'order_id' => $order->id,
            'user_id' => $order->user_id
        ]);
        $discount->max_usage = $discount->max_usage - 1;
        $discount->save();
    }

    protected function storeOrderDetail($orderId, $data)
    {
        foreach ($data as $item) {
            $item['order_id'] = $orderId;
            $this->orderDetailRepository->create($item);
        }
    }

    private function prepareData($cartItems)
    {
        foreach ($cartItems as $item) {
            $product = $this->productRepository->findOrFail($item->product_id);
            if ($product->type == ProductType::Simple) {
                $unitPrice = $product->on_flash_sale ? $product->flashsale_price : $product->promotion_price;
            } else {
                if ($this->getCurrentUser()) {
                    $productVariation = $this->productVariationRepository->findOrFail($item->product_variation_id);
                } else {
                    $productVariation = $this->productVariationRepository->findByProductAndAttributeVariation($item->product_id, $item->variation_id);
                }
                $unitPrice = $productVariation->product->on_flash_sale ? $productVariation->flashsale_price : $productVariation->promotion_price;
            }
            $this->orderDetails[] = [
                'product_id' => $product->id,
                'unit_price' => $unitPrice,
                'product_variation_id' => isset($productVariation) ? $productVariation->id : null,
                'qty' => $item->qty,
            ];
        }
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        try {
            if ($this->getCurrentUser()) {
                DB::beginTransaction();
                $product = $this->productRepository->findOrFail($this->data['product_id']);

                $compare = [
                    'user_id' => auth()->user()->id,
                    'product_id' => $this->data['product_id']
                ];

                if ($product->type == ProductType::Variable) {
                    $productVariation = $this->productVariationRepository->findByProductAndAttributeVariation($this->data['product_id'], $this->data['variation_id']);
                    $compare['product_variation_id'] = $productVariation->id;
                }

                $this->repository->updateOrCreate($compare, [
                    'qty' => DB::raw("qty + {$this->data['qty']}")
                ]);
                DB::commit();
                return true;
            } else {
                return $this->storeNotLogin($request);
            }
        } catch (Exception $e) {
            $this->logError('Failed to process store shopping cart: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function storeNotLogin(Request $request)
    {
        $this->data = $request->validated();

        // Lấy giỏ hàng từ cookie
        $cart = session('cart', []);

        $product = $this->productRepository->findOrFail($this->data['product_id']);
        // Kiểm tra số lượng sản phẩm
        foreach ($cart as $item) {;
            if ($item['product_id'] == $this->data['product_id']) {
                if ($product->isSimple()) {
                    if ($product->qty < intval($this->data['qty']) + $item['qty']) {
                        return 1;
                    }
                } else {
                    $productVariation = $this->productVariationRepository->findByProductAndAttributeVariation($this->data['product_id'], $this->data['variation_id']);
                    if ($productVariation->qty < intval($this->data['qty']) + $item['qty']) {
                        return 1;
                    }
                }
            }
        }

        $productExists = false;
        foreach ($cart as &$item) {
            if (
                $item['product_id'] == $this->data['product_id'] &&
                $item['variation_id'] == ($this->data['variation_id'] ?? null)
            ) {
                $item['qty'] += $this->data['qty'];
                $productExists = true;
                break;
            }
        }

        if (!$productExists) {
            $cart[] = [
                'id' => $this->uniqidReal(),
                'product' => $product,
                'productVariation' => isset($this->data['variation_id']) ? $this->productVariationRepository->findByProductAndAttributeVariation($this->data['product_id'], $this->data['variation_id']) : null,
                'product_id' => $this->data['product_id'],
                'variation_id' => $this->data['variation_id'] ?? null,
                'product_variation_id' => $this->data['variation_id'] ?? true,
                'qty' => $this->data['qty'],
            ];
        }

        return $cart;
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        try {
            DB::beginTransaction();
            if ($this->getCurrentUser()) {
                $this->repository->updateMultiple($this->data['id'], $this->data['qty']);
                DB::commit();
                return true;
            } else {
                $cart = session('cart', []);
                foreach ($this->data['id'] as $key => $value) {
                    foreach ($cart as &$item) {
                        if ($item['id'] == $value) {
                            $item['qty'] = (int) $this->data['qty'][$key];
                            break;
                        }
                    }
                }
                DB::commit();
                return $cart;
            }
        } catch (Exception $e) {
            DB::rollBack();
            $this->logError('Failed to process update shopping cart: ', $e);
            return false;
        }
    }

    public function deleteMultiple(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($this->getCurrentUser()) {
                $this->repository->deleteMultiple($request->input('id'));
                DB::commit();
                return true;
            } else {
                $cart = session('cart', []);
                $idsToDelete = $request->input('id', []);
                $cart = array_filter($cart, function ($item) use ($idsToDelete) {
                    return !in_array($item['id'], $idsToDelete);
                });
                DB::commit();
                return $cart;
            }
        } catch (Exception $e) {
            DB::rollBack();
            $this->logError('Failed to process delete shopping cart: ', $e);
            return false;
        }
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
