<?php

namespace App\Admin\Http\Controllers\District;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\District\DistrictRepositoryInterface;
use App\Admin\Http\Resources\District\DistrictSearchSelectResource;

class DistrictSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        DistrictRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => DistrictSearchSelectResource::collection($this->instance)
        ];
    }
}