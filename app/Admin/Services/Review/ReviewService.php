<?php

namespace App\Admin\Services\Review;

use App\Admin\Services\Review\ReviewServiceInterface;
use App\Admin\Repositories\Review\ReviewRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Traits\UseLog;
use Exception;
use Illuminate\Support\Facades\DB;

class ReviewService implements ReviewServiceInterface
{
    use Setup, UseLog;
    protected $data;
    protected $repository;

    public function __construct(
        ReviewRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $review = $this->repository->create($this->data);
            DB::commit();
            return $review;
        } catch (Exception $e) {
            $this->logError('Failed to process review: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();

        DB::beginTransaction();
        try {
            $this->repository->update($this->data['id'], $this->data);
            DB::commit();
            return true;
        } catch (Exception $e) {

            $this->logError('Failed to process review: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
