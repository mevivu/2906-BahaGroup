<?php

namespace App\Admin\Services\FlashSale;

use  App\Admin\Repositories\FlashSale\FlashSaleRepositoryInterface;
use App\Admin\Repositories\Product\ProductRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class FlashSaleService implements FlashSaleServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;

    protected FlashSaleRepositoryInterface $repository;
    protected ProductRepository $productRepository;

    public function __construct(
        FlashSaleRepositoryInterface $repository,
        ProductRepository $productRepository
    ) {
        $this->repository = $repository;
        $this->productRepository = $productRepository;
    }


    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $this->data = $request->validated();
            $flashSale = $this->repository->update($this->data['id'], $this->data);
            $flashSale->details->each(function ($detail) {
                $detail->delete();
            });
            $this->createAndStoreDataFlashSaleDetails($flashSale);
            DB::commit();

            return $flashSale;
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Failed to update flash sale:', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * @throws Exception
     */
    public function delete($id): object|bool
    {
        return $this->repository->delete($id);
    }


    /**
     * @throws Exception
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $this->data = $request->validated();
            $flashSale = $this->repository->create($this->data);
            $this->createAndStoreDataFlashSaleDetails($flashSale);
            DB::commit();

            return $flashSale;
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Failed to create flash sale:', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function addProduct(Request $request)
    {
        $data = $request->validated();
        $product = $this->productRepository->findOrFail($data['product_id']);
        return $product;
    }

    private function createAndStoreDataFlashSaleDetails(object $flashSale): void
    {
        $flashSaleDetails = [];
        foreach ($this->data['product_id'] as $key => $productId) {
            $flashSaleDetails[] = [
                'product_id' => $productId,
                'qty' => $this->data['qty'][$productId],
                'flash_sale_id' => $flashSale->id
            ];
        }
        foreach ($flashSaleDetails as $item) {
            $flashSale->details()->create($item);
        }
    }
}
