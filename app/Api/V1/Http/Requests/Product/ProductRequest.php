<?php

namespace App\Api\V1\Http\Requests\Product;

use App\Api\V1\Http\Requests\BaseRequest;

class ProductRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [
            'keywords' => ['nullable', 'string'],
            'limit' => ['nullable', 'string'],
            'page' => ['nullable', 'string'],
        ];
    }
}
