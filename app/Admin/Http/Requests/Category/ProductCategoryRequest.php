<?php

namespace App\Admin\Http\Requests\Category;

use App\Admin\Http\Requests\BaseRequest;
use App\Admin\Rules\Category\CategoryParent;
use App\Enums\Category\HomeSliderOption;
use Illuminate\Validation\Rules\Enum;

class ProductCategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'name' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:App\Models\Category,id'],
            'position' => ['required', 'integer', 'min:0'],
            'is_active' => ['required'],
            'is_menu' => ['required'],
            'is_home_slider_1' => ['nullable', new Enum(HomeSliderOption::class)],
            'is_home_slider_2' => ['nullable', new Enum(HomeSliderOption::class)],
            'icon' => ['nullable'],
            'avatar' => ['required']
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\Category,id'],
            'name' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:App\Models\Category,id', new CategoryParent($this->id)],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_home_slider_1' => ['nullable', new Enum(HomeSliderOption::class)],
            'is_home_slider_2' => ['nullable', new Enum(HomeSliderOption::class)],
            'is_active' => ['required'],
            'is_menu' => ['required'],
            'icon' => ['nullable'],
            'avatar' => ['required']
        ];
    }
}
