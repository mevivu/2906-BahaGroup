<?php

namespace App\Admin\Http\Requests\Auth;

use App\Admin\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{
    protected function methodPost()
    {
        return
            [
                'fullname' => 'required',
                'email' => 'required|email|unique:users,email|unique:admins,email',
                'password' => 'required|min:6',
                'confirmed' => 'required|same:password',
            ];
    }
}
