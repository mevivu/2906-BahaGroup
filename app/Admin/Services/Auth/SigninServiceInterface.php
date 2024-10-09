<?php

namespace App\Admin\Services\Auth;

interface SigninServiceInterface
{
    public function register(array $data = []);
    public function oauth(array $data = []);
}
