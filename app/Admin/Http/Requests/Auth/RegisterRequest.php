<?php

namespace App\Admin\Http\Requests\Auth;

use App\Admin\Http\Requests\BaseRequest;

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
            'fullname' => 'required',
            'email' => 'required|email',
            'birthday' => 'required|date_format:Y-m-d',
            'gender' => 'required',
            'password' => 'required|min:6',
            'confirmed' => 'required|same:password',
        ];
    }
}
