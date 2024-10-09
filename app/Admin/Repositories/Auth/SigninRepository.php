<?php

namespace App\Admin\Repositories\Auth;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Auth\SigninRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SigninRepository extends EloquentRepository implements SigninRepositoryInterface
{
    protected $select;

    public function getModel()
    {
        return User::class;
    }

    public function signin(array $data = [], $remember = false)
    {
        return $this->model->create([
            'code' => $data['code'],
            'slug' => $data['slug'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'password' => $data['password'],
            'active' => 0,
            'oauth' => $data['oauth'],
        ]);
    }

    public function findByEmail(array $array)
    {
        $this->instance = $this->model->where(['email' => $array['email']])->first();

        return $this->instance;
    }
}
