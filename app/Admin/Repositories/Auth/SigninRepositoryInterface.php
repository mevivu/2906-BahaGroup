<?php

namespace App\Admin\Repositories\Auth;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface SigninRepositoryInterface extends EloquentRepositoryInterface
{
    public function signin(array $array = [], $remember = false);
    public function findByEmail(array $array);
    public function findByToken(string $token);
}