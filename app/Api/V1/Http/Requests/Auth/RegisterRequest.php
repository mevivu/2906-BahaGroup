<?php

namespace App\Api\V1\Http\Requests\Auth;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'fullname' => ['required', 'string'],
            'phone' => [
                'required',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }

    /**
     * Configure the validator to include an after validation hook.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $email = $this->input('email');
            $phone = $this->input('phone');

            if (User::where('email', $email)->where('active', 1)->exists()) {
                $validator->errors()->add('email', __('Email đã được đăng ký.'));
            }

            if (User::where('phone', $phone)->where('active', 1)->exists()) {
                $validator->errors()->add('phone', __('Số điện thoại đã được đăng ký.'));
            }
        });
    }
}
