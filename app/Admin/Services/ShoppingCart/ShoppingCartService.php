<?php

namespace App\Admin\Services\ShoppingCart;

use App\Admin\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Admin\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use App\Admin\Repositories\Product\{ProductRepositoryInterface, ProductVariationRepositoryInterface};
use App\Admin\Traits\AuthService;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingCartService implements ShoppingCartServiceInterface
{
    use UseLog;
    use AuthService;
    protected $data;

    protected $repository;
    protected $repositoryProduct;
    protected $repositoryProductVariation;

    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        ProductRepositoryInterface $repositoryProduct,
        ProductVariationRepositoryInterface $repositoryProductVariation,
    ) {
        $this->repository = $repository;
        $this->repositoryProduct = $repositoryProduct;
        $this->repositoryProductVariation = $repositoryProductVariation;
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
            if (!isset($shoppingCart[0])) {
                $shoppingCart = $this->repository->create([
                    'user_id' => $this->getCurrentUserId(),
                    'product_id' => $this->data['product_id'],
                    'product_variation_id' => $this->data['product_variation_id'] ?? null,
                    'qty' => $this->data['qty'],
                ]);
            } else {
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

    public function deleteMultiple(Request $request)
    {
        return $this->repository->deleteMultiple($request->input('id'));
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
