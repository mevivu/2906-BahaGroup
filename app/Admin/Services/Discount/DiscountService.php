<?php

namespace App\Admin\Services\Discount;

use  App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class DiscountService implements DiscountServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;

    protected DiscountRepositoryInterface $repository;

    public function __construct(
        DiscountRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }


    public function update(Request $request): object|bool
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $discountId = $data['id'];
            $discount = $this->repository->update($discountId, $data);
            DB::commit();
            return $discount;
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Discount update failed:', [
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
            $data = $request->validated();

            $discount = $this->repository->create($data);
            DB::commit();

            return $discount;
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Failed to create discount:', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
