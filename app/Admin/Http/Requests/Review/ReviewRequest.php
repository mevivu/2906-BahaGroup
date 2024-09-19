<?php

namespace App\Admin\Http\Requests\Review;

use App\Admin\Http\Requests\BaseRequest;

class ReviewRequest extends BaseRequest
{

    protected function methodPost(): array
    {
        return [
            'user_id' => ['required', 'exists:App\Models\User,id'],
            'product_id' => ['required', 'exists:App\Models\Product,id'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'content' => ['nullable'],
        ];
    }

    protected function methodPut(): array
    {
        return [
            'user_id' => ['required', 'exists:App\Models\User,id'],
            'product_id' => ['required', 'exists:App\Models\Product,id'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'content' => ['nullable'],
        ];
    }
    protected function methodGet(): array
    {
        return [
            'product_id' => ['required', 'exists:App\Models\Product,id'],
            'rating' => ['nullable'],
            'per_page' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
