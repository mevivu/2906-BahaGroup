<?php

namespace App\Admin\Services\ShoppingCart;

use App\Admin\Repositories\Discount\DiscountApplicationRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Repositories\Order\OrderDetailRepositoryInterface;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Admin\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Admin\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use App\Admin\Repositories\Product\{ProductRepositoryInterface, ProductVariationRepositoryInterface};
use App\Admin\Traits\AuthService;
use App\Admin\Traits\Setup;
use App\Enums\Discount\DiscountType;
use App\Enums\Order\OrderStatus;
use App\Enums\Product\ProductType;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingCartService implements ShoppingCartServiceInterface
{
    use UseLog, Setup, AuthService;

    protected $data;
    protected $orderDetails;

    protected $repository;
    protected $orderRepository;
    protected $productRepository;
    protected $productRepositoryVariation;
    protected $repositoryOrderDetail;
    protected $discountRepository;
    protected $discountApplicationRepository;

    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        ProductVariationRepositoryInterface $productRepositoryVariation,
        OrderDetailRepositoryInterface $repositoryOrderDetail,
        DiscountRepositoryInterface $discountRepository,
        DiscountApplicationRepositoryInterface $discountApplicationRepository,
    ) {
        $this->repository = $repository;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->productRepositoryVariation = $productRepositoryVariation;
        $this->repositoryOrderDetail = $repositoryOrderDetail;
        $this->discountRepository = $discountRepository;
        $this->discountApplicationRepository = $discountApplicationRepository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $shoppingCart = $this->repository->getBy([
                'user_id' => $this->getCurrentUserId(),
                'product_id' => $this->data['product_id'],
                'product_variation_id' => $this->data['product_variation_id'] ?? null, // Use null coalescing operator for optional product variation
            ]);
            $product = $this->productRepository->find($this->data['product_id']);
            if (!isset($shoppingCart[0])) {
                if ($product->isSimple()) {
                    if ($product->qty < $this->data['qty']) {
                        DB::rollBack();
                        return 1;
                    }
                } else {
                    $productVariation = $product->productVariations()->where('id', $this->data['product_variation_id'])->first();
                    if ($productVariation->qty < $this->data['qty']) {
                        DB::rollBack();
                        return 1;
                    }
                }
                $shoppingCart = $this->repository->create([
                    'user_id' => $this->getCurrentUserId(),
                    'product_id' => $this->data['product_id'],
                    'product_variation_id' => $this->data['product_variation_id'] ?? null,
                    'qty' => $this->data['qty'],
                ]);
            } else {
                if ($product->isSimple()) {
                    if ($product->qty < ($shoppingCart[0]->qty + $this->data['qty'])) {
                        DB::rollBack();
                        return 1;
                    }
                } else {
                    $productVariation = $product->productVariations()->where('id', $this->data['product_variation_id'])->first();
                    if ($productVariation->qty < ($shoppingCart[0]->qty + $this->data['qty'])) {
                        DB::rollBack();
                        return 1;
                    }
                }
                $shoppingCart[0]->update(['qty' => $shoppingCart[0]->qty + $this->data['qty']]);
            }
            DB::commit();
            return $shoppingCart;
        } catch (Exception $e) {
            $this->logError('Failed to process shopping cart: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $shoppingCart = $this->repository->findOrFail($this->data['id']);
            $shoppingCart->update(['qty' => $this->data['qty']]);
            DB::commit();
            return $shoppingCart;
        } catch (Exception $e) {
            $this->logError('Failed to update shopping cart: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function increament(Request $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $shoppingCart = $this->repository->findOrFail($this->data['id']);
            $shoppingCart->update(['qty' => $shoppingCart->qty + 1]);
            DB::commit();
            return $shoppingCart;
        } catch (Exception $e) {
            $this->logError('Failed to increament quantity shopping cart: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function decreament(Request $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $shoppingCart = $this->repository->findOrFail($this->data['id']);
            if ($shoppingCart->qty > 1) {
                $shoppingCart->update(['qty' => $shoppingCart->qty - 1]);
            } else {
                $this->delete($shoppingCart->id);
            }
            DB::commit();
            return $shoppingCart;
        } catch (Exception $e) {
            $this->logError('Failed to decreament quantity shopping cart: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function checkout(Request $request)
    {
        $this->data = $request->validated();
        $user = $this->getCurrentUser();
        $this->data['order']['status'] = OrderStatus::Pending->value;
        $this->data['order']['code'] = $this->createCodeOrder();
        $this->data['order']['user_id'] = $user->id;
        $this->data['order']['total'] = $this->calculageTotal($user);
        $this->data['order']['user_id'] = $user->id;
        DB::beginTransaction();
        try {
            $this->prepareData($user->shopping_cart);
            if (isset($this->data['code'])) {
                $discount = $this->discountRepository->findByField('code', $this->data['code']);
                $this->data['order']['discount_value'] = $this->calculageDiscountValue($this->data['order']['total'], $discount);
            }
            $order = $this->orderRepository->create($this->data['order']);
            $this->handleDiscount($order, $discount);
            if (isset($this->data['code'])) {
                $this->handleDiscount($order, $discount);
            }
            $this->storeOrderDetail($order->id, $this->orderDetails);
            $user->shopping_cart()->delete();
            DB::commit();
            return $order;
        } catch (Exception $e) {
            $this->logError('Failed to process checkout: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function calculageTotal($user)
    {
        $total = 0;
        $shoppingCart = $user->shopping_cart;
        foreach ($shoppingCart as $item) {
            $total += $item->product_variation_id
                ? ($item->product->on_flash_sale ? $item->productVariation->flashsale_price * $item->qty : $item->productVariation->promotion_price * $item->qty)
                : ($item->product->on_flash_sale ? $item->product->flashsale_price * $item->qty : $item->product->promotion_price * $item->qty);
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
                    'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này',
                ], 400);
            }
        } else {
            if ($total >= $discount->min_order_amount) {
                $discountValue =  $discount->discount_value;
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này',
                ], 400);
            }
        }
        return $discountValue;
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
            $this->repositoryOrderDetail->create($item);
        }
    }

    private function prepareData($cartItems)
    {
        foreach ($cartItems as $item) {
            $product = $this->productRepository->find($item->product->id);
            if ($product->type == ProductType::Simple) {
                $unitPrice = $product->promotion_price ?: $product->price;
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
}
