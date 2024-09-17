<?php

namespace App\Admin\Http\Requests\Auth;

use App\Admin\Http\Requests\BaseRequest;

class ProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPut()
    {
        if (auth('admin')->user()) {
            $this->validate = [
                'fullname' => ['required', 'string', 'max:255'],
                'phone' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\Admin,phone,' . auth('admin')->user()->id],
                'address' => ['nullable']
            ];
            return $this->validate;
        } else {
            $this->validate = [
                'fullname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone,' . auth('web')->user()->id],
                'email' => ['required', 'unique:App\Models\User,email,' . auth('web')->user()->id],
                'address' => ['nullable'],
                'birthday' => ['required'],
                'gender' => ['required'],
            ];
            return $this->validate;
        }
    }
}
