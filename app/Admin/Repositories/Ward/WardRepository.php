<?php

namespace App\Admin\Repositories\Ward;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Ward\WardRepositoryInterface;
use App\Models\Ward;

class WardRepository extends EloquentRepository implements WardRepositoryInterface
{
    public function getModel(){
        return Ward::class;
    }
    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10){

        $this->instance = $this->model->where('name', 'like', "%{$keySearch}%");
        
        foreach($meta as $key => $value){
            $this->instance = $this->instance->where($key, $value);
        }
        return $this->instance->limit($limit)->get();
    }
}