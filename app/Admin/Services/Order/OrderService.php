<?php

namespace App\Admin\Services\Order;

use App\Admin\Repositories\Discount\DiscountApplicationRepositoryInterface;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Admin\Repositories\Order\{OrderRepositoryInterface, OrderDetailRepositoryInterface};
use App\Admin\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Repositories\Product\{ProductRepositoryInterface, ProductVariationRepositoryInterface};
use App\Admin\Traits\Setup;
use App\Enums\Discount\DiscountType;
use App\Enums\Product\ProductType;
use App\Enums\Order\{OrderStatus};
use App\Traits\UseLog;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    use Setup, UseLog;
    protected $data;
    protected $orderDetails;
    protected $repository;
    protected $repositoryUser;
    protected $repositoryProduct;
    protected $repositoryProductVariation;
    protected $repositoryOrderDetail;
    protected $discountRepository;
    protected $discountApplicationRepository;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderDetailRepositoryInterface $repositoryOrderDetail,
        DiscountRepositoryInterface $discountRepository,
        DiscountApplicationRepositoryInterface $discountApplicationRepository,
        UserRepositoryInterface $repositoryUser,
        ProductRepositoryInterface $repositoryProduct,
        ProductVariationRepositoryInterface $repositoryProductVariation,
    ) {
        $this->repository = $repository;
        $this->repositoryOrderDetail = $repositoryOrderDetail;
        $this->discountRepository = $discountRepository;
        $this->discountApplicationRepository = $discountApplicationRepository;
        $this->repositoryUser = $repositoryUser;
        $this->repositoryProduct = $repositoryProduct;
        $this->repositoryProductVariation = $repositoryProductVariation;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        $this->data['order']['status'] = OrderStatus::Pending->value;
        $this->data['order']['code'] = $this->createCodeOrder();
        DB::beginTransaction();
        try {
            if (!$this->makeNewDataOrderDetail()) {
                return false;
            }
            $order = $this->repository->create($this->data['order']);
            if (isset($this->data['order']['discount_id'])) {
                $this->handleDiscount('store', $order);
            }
            $this->storeOrderDetail($order->id, $this->orderDetails);
            DB::commit();
            return $order;
        } catch (Exception $e) {
            $this->logError('Failed to process order: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function checkValidDiscount(Request $request)
    {
        $this->data = $request->validated();
        if (isset($this->data['order']['discount_id'])) {
            $discount = $this->discountRepository->findOrFail($this->data['order']['discount_id']);
            if ($discount->min_order_amount > $this->data['order']['total']) {
                return false;
            }
        }
        return true;
    }

    public function confirm($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->repository->findOrFail($id);
            foreach ($order->details as $detail) {
                if ($detail->product_variation_id) {
                    if ($detail->productVariation->qty >= $detail->qty) {
                        $this->repositoryProductVariation->update(
                            $detail->product_variation_id,
                            ['qty' => $detail->productVariation->qty - $detail->qty]
                        );
                    } else {
                        DB::rollBack();
                        return $detail->productVariation->product->name;
                    }
                } else {
                    if ($detail->product->qty >= $detail->qty) {
                        $this->repositoryProduct->update(
                            $detail->product_id,
                            ['qty' => $detail->product->qty - $detail->qty]
                        );
                    } else {
                        DB::rollBack();
                        return $detail->product->name;
                    }
                }
                if ($detail->product->on_flash_sale) {
                    $flashSaleDetail = $detail->product->on_flash_sale->details()->firstWhere('product_id', $detail->product_id);
                    $remainFlashSaleQty = $flashSaleDetail->qty - $flashSaleDetail->sold;

                    if ($remainFlashSaleQty >= $detail->qty) {
                        $flashSaleDetail->update(['sold' => $flashSaleDetail->sold + $detail->qty]);
                    } else {
                        if ($remainFlashSaleQty > 0) {
                            $flashSaleDetail->update(['sold' => $flashSaleDetail->qty]);
                            $surcharge = ($detail->product->promotion_price - $detail->unit_price) * ($detail->qty - $remainFlashSaleQty);
                            $order->surcharge = ($order->surcharge ?? 0) + $surcharge;
                            if ($order->discount) {
                                if ($order->discount->type != DiscountType::Money->value) {
                                    $surcharge = $surcharge - $surcharge * $order->discount->discount_value / 100;
                                }
                            }
                            $note = "Áp dụng flash sale cho " . $remainFlashSaleQty . " sản phẩm " . $detail->product->name . ". " . ($detail->qty - $remainFlashSaleQty) . " sản phẩm còn lại được tính giá thường. " .
                                "Phụ thu: " . format_price($surcharge) . " đã được thêm vào tổng đơn hàng.";
                            $order->note = ($order->note ? $order->note . "\n\n" : '') . $note;
                            $order->total = $order->total + $surcharge;
                            $order->save();
                        }
                    }
                } else {
                    if ($detail->productVariation) {
                        if ($detail->unit_price == $detail->productVariation->flashsale_price) {
                            DB::rollBack();
                            return 1;
                        }
                    } else {
                        if ($detail->unit_price == $detail->product->flashsale_price) {
                            DB::rollBack();
                            return 1;
                        }
                    }
                }
            }
            $order->update(['status' => OrderStatus::Confirmed]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            $this->logError('Failed to confirm order: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function cancel($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->repository->update($id, ['status' => OrderStatus::Cancelled]);
            if ($order->discount) {
                $discount = $this->discountRepository->findOrFail($order->discount->id);
                $discount->max_usage = $discount->max_usage + 1;
                $discount->save();
                $discountApplication = $this->discountApplicationRepository->findByField('order_id', $order->id);
                $discountApplication->delete();
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            $this->logError('Failed to cancel order: ', $e);
            DB::rollBack();
            return false;
        }
    }

    private function makeNewDataOrderDetail()
    {
        $products = $this->repositoryProduct->getByIdsAndOrderByIds(
            array_unique($this->data['order_detail']['product_id'])
        );
        if ($products->count() == 0) {
            return false;
        }
        $this->dataOrderDetail($products);
        return true;
    }
    private function dataOrderDetail($products)
    {
        foreach ($this->data['order_detail']['product_id'] as $key => $value) {
            $product = $products->firstWhere('id', $value);
            if ($product->type == ProductType::Simple) {
                $unitPrice = $product->on_flash_sale ? $product->flashsale_price : $product->promotion_price;
            } else {
                $product = $product->load(['productVariation' => function ($query) use ($key) {
                    $query->with('attributeVariations')->where('id', $this->data['order_detail']['product_variation_id'][$key]);
                }]);
                $unitPrice = $product->productVariation->promotion_price ?: $product->productVariation->price;
                unset($product->productVariation);
            }
            $unitPrice = $product->is_user_discount ? $unitPrice : $unitPrice;
            $this->orderDetails[] = [
                'product_id' => $product->id,
                'unit_price' => $unitPrice,
                'product_variation_id' => $this->data['order_detail']['product_variation_id'][$key] ?: null,
                'qty' => $this->data['order_detail']['product_qty'][$key],
            ];
        }
    }

    protected function storeOrderDetail($orderId, $data)
    {
        foreach ($data as $item) {
            $item['order_id'] = $orderId;
            $this->repositoryOrderDetail->create($item);
        }
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            if (isset($this->data['order']['user_id'])) {
                $dataOrderDetail = $this->updateOrCreateDataOrderDetail();
                if (!empty($dataOrderDetail)) {
                    $this->data['order_detail'] = $dataOrderDetail;
                    $this->makeNewDataOrderDetail();
                    $this->storeOrderDetail($this->data['order']['id'], $this->orderDetails);
                }
            }
            if (isset($this->data['order']['discount_id'])) {
                $this->handleDiscount('update', '');
            }
            $order = $this->repository->update($this->data['order']['id'], $this->data['order']);
            DB::commit();
            return $order;
        } catch (Exception $e) {

            $this->logError('Failed to process order: ', $e);
            DB::rollBack();
            return false;
        }
    }

    private function handleDiscount($type, $order)
    {
        if ($type == 'store') {
            $discount = $this->discountRepository->findOrFail($this->data['order']['discount_id']);
            $this->discountApplicationRepository->create([
                'discount_code_id' => $discount->id,
                'order_id' => $order->id,
                'user_id' => $order->user_id
            ]);
            $discount->max_usage = $discount->max_usage - 1;
            $discount->save();
        } else {
            $oldOrder = $this->repository->findOrFail($this->data['order']['id']);
            $discount = $this->discountRepository->findOrFail($this->data['order']['discount_id']);
            $discount->max_usage = $discount->max_usage - 1;
            $discount->save();
            if ($oldOrder->discount) {
                if ($oldOrder->discount->id != $this->data['order']['discount_id']) {
                    $oldDiscount = $this->discountRepository->findOrFail($oldOrder->discount->id);
                    $oldDiscount->max_usage = $oldDiscount->max_usage + 1;
                    $oldDiscount->save();
                    $discountApplication = $this->discountApplicationRepository->findByField('order_id', $oldOrder->id);
                    $discountApplication->discount_code_id = $discount->id;
                    $discountApplication->save();
                }
            } else {
                $this->discountApplicationRepository->create([
                    'discount_code_id' => $discount->id,
                    'order_id' => $this->data['order']['id'],
                    'user_id' => $this->data['order']['user_id']
                ]);
            }
        }
    }

    private function updateOrCreateDataOrderDetail()
    {
        $data = [];
        foreach ($this->data['order_detail']['id'] as $key => $value) {
            if ($value == 0) {
                $data['product_id'][] = $this->data['order_detail']['product_id'][$key];
                $data['product_variation_id'][] = $this->data['order_detail']['product_variation_id'][$key];
                $data['product_qty'][] = $this->data['order_detail']['product_qty'][$key];
            } else {
                $this->repositoryOrderDetail->update(
                    $value,
                    [
                        'qty' => $this->data['order_detail']['product_qty'][$key]
                    ]
                );
            }
        }
        return $data;
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function addProduct(Request $request)
    {
        $data = $request->validated();
        $product = $this->repositoryProduct->findOrFail($data['product_id']);
        if ($product->type == ProductType::Variable) {
            $product = $product->load(['productVariation' => function ($query) use ($data) {
                $query->where('id', $data['product_variation_id'] ?? 0)->with('attributeVariations');
            }]);
            if (!$product->productVariation) {
                return false;
            }
            if ($product->is_user_discount) {
                $product->productVariation->promotion_price = $product->productVariation->promotion_price ?: $product->productVariation->promotion_price;
            }
        } else {
            if ($product->is_user_discount) {
                $product->promotion_price = $product->promotion_price ?: $product->promotion_price;
            }
        }

        return $product;
    }

    public function calculateTotal(Request $request)
    {
        $data = $request->validated('order_detail');
        $total = 0;
        $productSimple = [];
        $productVariation = [];
        foreach ($data['product_id'] as $key => $value) {
            if ($data['product_variation_id'][$key] == 0) {
                $productSimple[] = [
                    'id' => $value,
                    'qty' => $data['product_qty'][$key]
                ];
            } else {
                $productVariation[] = [
                    'id' => $data['product_variation_id'][$key],
                    'qty' => $data['product_qty'][$key]
                ];
            }
        }
        if (!empty($productSimple)) {
            $total += $this->totalPrice(
                $this->repositoryProduct->getByIdsAndOrderByIds(array_column($productSimple, 'id')),
                array_column($productSimple, 'qty'),
            );
        }
        if (!empty($productVariation)) {
            $total += $this->totalPrice(
                $this->repositoryProductVariation->getByIdsAndOrderByIdsWithRelations(array_column($productVariation, 'id')),
                array_column($productVariation, 'qty'),
            );
        }
        return $total;
    }

    public function totalPrice($collect, $qty)
    {
        $total = 0;
        $total += $collect->mapWithKeys(function ($item, $key) use ($qty) {
            $price = ($item->promotion_price ?: $item->price) * $qty[$key];

            if ($item->is_user_discount || optional($item->product)->is_user_discount) {
                $price = ($item->promotion_price ?? $item->price) * $qty[$key];
            }
            return [$item->id => $price];
        })->sum();
        return $total;
    }
}
