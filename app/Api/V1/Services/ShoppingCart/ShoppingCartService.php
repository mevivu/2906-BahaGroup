<?php

namespace App\Api\V1\Services\ShoppingCart;

use App\Admin\Repositories\Discount\DiscountApplicationRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Repositories\Order\OrderDetailRepositoryInterface;
use App\Admin\Traits\AuthService;
use App\Admin\Traits\Setup;
use App\Api\V1\Repositories\Order\OrderRepositoryInterface;
use App\Api\V1\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Api\V1\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use App\Api\V1\Repositories\Product\{ProductRepositoryInterface, ProductVariationRepositoryInterface};
use App\Enums\Discount\DiscountType;
use App\Enums\Order\OrderReview;
use App\Enums\Order\OrderStatus;
use App\Enums\Product\ProductType;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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

    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        OrderDetailRepositoryInterface $orderDetailRepository,
        ProductVariationRepositoryInterface $productVariationRepository,
        DiscountRepositoryInterface $discountRepository,
        DiscountApplicationRepositoryInterface $discountApplicationRepository,
    ) {
        $this->repository = $repository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->productRepository = $productRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->discountRepository = $discountRepository;
        $this->discountApplicationRepository = $discountApplicationRepository;
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
        return $item->product_variation_id
            ? ($item->product->on_flash_sale ? $item->productVariation->flashsale_price * $item->qty : $item->productVariation->promotion_price * $item->qty)
            : ($item->product->on_flash_sale ? $item->product->flashsale_price * $item->qty : $item->product->promotion_price * $item->qty);
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
            $product = $item->product;
            if ($product->type == ProductType::Simple) {
                $unitPrice = $product->on_flash_sale ? $product->flashsale_price : $product->promotion_price;
            } else {
                $instance = $product->productVariation()->where('id', $item->product_variation_id)->first();
                $unitPrice = $instance->product->on_flash_sale ? $instance->flashsale_price : $instance->promotion_price;
            }
            $this->orderDetails[] = [
                'product_id' => $product->id,
                'unit_price' => $unitPrice,
                'product_variation_id' => $item->product_variation_id ?: null,
                'qty' => $item->qty,
            ];
        }
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        try {
            if ($this->getCurrentUser()) {
                $product = $this->productRepository->findOrFail($this->data['product_id']);

                $compare = [
                    'user_id' => auth()->user()->id,
                    'product_id' => $this->data['product_id']
                ];

                if ($product->type == ProductType::Variable) {
                    $productVariation = $this->productVariationRepository->findByProductAndAttributeVariation($this->data['product_id'], $this->data['variation_id']);
                    $compare['product_variation_id'] = $productVariation->id;
                }

                $instance = $this->repository->updateOrCreate($compare, [
                    'qty' => DB::raw("qty + {$this->data['qty']}")
                ]);

                return $instance;
            } else {
                return $this->storeNotLogin($request);
            }
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }

    public function storeNotLogin(Request $request)
    {
        $this->data = $request->validated();

        // Lấy giỏ hàng từ cookie
        $cart = json_decode($request->cookie('cart', '[]'), true);

        $product = $this->productRepository->findOrFail($this->data['product_id']);

        // Kiểm tra số lượng sản phẩm
        foreach ($cart as $item) {
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
                'qty' => $this->data['qty'],
            ];
        }

        return $cart;
    }

    public function update(Request $request)
    {

        $this->data = $request->validated();
        $instance = $this->repository->updateMultiple($this->data['id'], $this->data['qty']);

        return $instance;
    }

    public function deleteMultiple(Request $request)
    {
        return $this->repository->deleteMultiple($request->input('id'));
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
