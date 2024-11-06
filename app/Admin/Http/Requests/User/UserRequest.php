<?php

namespace App\Admin\Http\Requests\User;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\User\Gender;
use Illuminate\Validation\Rules\Enum;

class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [

            'fullname' => ['required', 'string'],
            'phone' => [
                'required',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
                'unique:App\Models\User,phone'
            ],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'address' => ['nullable'],
            'password' => ['required', 'string', 'confirmed'],
            'gender' => ['required', new Enum(Gender::class)],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'active' => ['required'],
            'avatar' => ['nullable']
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\User,id'],
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\User,email,' . $this->id],
            'phone' => [
                'required',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
                'unique:App\Models\User,phone,' . $this->id
            ],
            'address' => ['nullable'],
            'password' => ['nullable', 'string', 'confirmed'],
            'gender' => ['required', new Enum(Gender::class)],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'avatar' => ['nullable'],
            'active' => ['required'],
        ];
    }
}
