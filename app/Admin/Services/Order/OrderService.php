<?php

namespace App\Admin\Services\Order;

use App\Admin\Services\Order\OrderServiceInterface;
use App\Admin\Repositories\Order\{OrderRepositoryInterface, OrderDetailRepositoryInterface};
use App\Admin\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Repositories\Product\{ProductRepositoryInterface, ProductVariationRepositoryInterface};
use App\Admin\Repositories\Vehicle\VehicleRepositoryInterface;
use App\Admin\Traits\Setup;
use App\Enums\Product\ProductType;
use App\Enums\Order\{OrderStatus};
use App\Enums\Payment\PaymentMethod;
use App\Enums\Vehicle\VehicleStatus;
use App\Traits\UseLog;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    use Setup, UseLog;
    protected $data;
    protected $orderDetails;
    protected $repository;
    protected $repositoryOrderDetail;
    protected $repositoryUser;
    protected $repositoryProduct;
    protected $repositoryProductVariation;
    protected $vehicleRepository;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderDetailRepositoryInterface $repositoryOrderDetail,
        UserRepositoryInterface $repositoryUser,
        ProductRepositoryInterface $repositoryProduct,
        ProductVariationRepositoryInterface $repositoryProductVariation,
        VehicleRepositoryInterface $vehicleRepository
    ) {
        $this->repository = $repository;
        $this->repositoryOrderDetail = $repositoryOrderDetail;
        $this->repositoryUser = $repositoryUser;
        $this->repositoryProduct = $repositoryProduct;
        $this->vehicleRepository = $vehicleRepository;
        $this->repositoryProductVariation = $repositoryProductVariation;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        $this->data['order']['payment_method'] = PaymentMethod::Online->value;
        $this->data['order']['status'] = OrderStatus::Pending->value;
        $this->data['order']['total'] = $this->calculateTotal($request);
        DB::beginTransaction();
        try {
            if (!$this->makeNewDataOrderDetail()) {
                return false;
            }
            $order = $this->repository->create($this->data['order']);
            $this->storeOrderDetail($order->id, $this->orderDetails);
            DB::commit();
            return $order;
        } catch (Exception $e) {
            $this->logError('Failed to process order: ', $e);
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
                $unitPrice = $product->promotion_price ?: $product->price;
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
            $order = $this->repository->update($this->data['order']['id'], $this->data['order']);
            $total = 0;
            foreach ($order->details as $detail) {
                $total += $detail->unit_price * $detail->qty;
            }
            $order->total = $total;
            $order->save();
            DB::commit();
            return $order;
        } catch (Exception $e) {

            $this->logError('Failed to process order: ', $e);
            DB::rollBack();
            return false;
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

    public function confirm($id)
    {
        $order = $this->repository->findOrFail($id);
        if ($order->status == OrderStatus::Pending) {
            $this->repository->update($id, ['status' => OrderStatus::Confirmed]);
            return $this->vehicleRepository->update($order->vehicle->id, ['status' => VehicleStatus::Rented]);
        }
        return false;
    }

    public function cancel($id)
    {
        $order = $this->repository->findOrFail($id);
        if ($order->status == OrderStatus::Confirmed) {
            $this->repository->update($id, ['status' => OrderStatus::Cancelled]);
            return $this->vehicleRepository->update($order->vehicle->id, ['status' => VehicleStatus::Pending]);
        }
        return $this->repository->update($id, ['status' => OrderStatus::Cancelled]);
        return false;
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
                $product->productVariation->price = $product->productVariation->price;
                $product->productVariation->promotion_price = $product->productVariation->promotion_price ?: $product->productVariation->promotion_price;
            }
        } else {
            if ($product->is_user_discount) {
                $product->price = $product->price;
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
