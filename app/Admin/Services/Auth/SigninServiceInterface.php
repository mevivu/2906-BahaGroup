<?php

namespace App\Admin\Services\Auth;

interface SigninServiceInterface
{
    public function register(array $data = []);
    public function oauth(array $data = []);
    public function forgotPassword(array $data = []);
    public function checkToken(string $token);
    public function changePassword(array $data = []);
}