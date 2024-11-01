<?php

namespace App\Api\V1\Http\Requests\Auth;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\User\Gender;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'fullname' => ['nullable', 'string'],
            'birthday' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'gender' => ['nullable', new Enum(Gender::class)],
            'address' => ['nullable'],
            'avatar' => ['nullable'],
        ];
    }

    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $email = $this->input('email');
            $phone = $this->input('phone');
            $userId = auth()->id();

            if (
                $email && User::where('email', $email)
                ->where('active', 1)
                ->where('id', '!=', $userId)
                ->exists()
            ) {
                $validator->errors()->add('email', __('Email đã được đăng ký.'));
            }

            if (
                $phone && User::where('phone', $phone)
                ->where('active', 1)
                ->where('id', '!=', $userId)
                ->exists()
            ) {
                $validator->errors()->add('phone', __('Số điện thoại đã được đăng ký.'));
            }
        });
    }
}
