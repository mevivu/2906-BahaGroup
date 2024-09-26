<?php

namespace App\Admin\Repositories\Ward;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Ward\WardRepositoryInterface;
use App\Models\District;
use App\Models\Ward;

class WardRepository extends EloquentRepository implements WardRepositoryInterface
{
    public function getModel(){
        return Ward::class;
    }
    public function searchAllLimit($keySearch = '', $districtId = 0)
    {
        $district = District::find($districtId);
        $this->instance = $this->model->where('district_code', $district[0]->code)->where('name', 'like', "%{$keySearch}%");
        return $this->instance->get();
    }
}
