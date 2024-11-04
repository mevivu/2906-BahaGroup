<?php

namespace App\Admin\Repositories\Discount;

use App\Admin\Repositories\EloquentRepository;
use App\Models\Discount;

class DiscountRepository extends EloquentRepository implements DiscountRepositoryInterface
{
    public function getModel(): string
    {
        return Discount::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {

        $this->instance = $this->model->where('code', 'like', "%{$keySearch}%")->where('max_usage', '!=', '0');

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }
        return $this->instance->get();
    }

    public function getValid()
    {
        $this->instance = $this->model
            ->where('max_usage', '>', 0)
            ->where('status', 1)
            ->whereDate('date_start', '<=', now())
            ->whereDate('date_end', '>=', now());

        return $this->instance->get();
    }
}
