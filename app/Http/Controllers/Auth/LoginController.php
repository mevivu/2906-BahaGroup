<?php

namespace App\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $login;
    public function getView()
    {
        return [
            'indexUser' => 'user.auth.login',
        ];
    }

    public function indexUser()
    {
        return view($this->view['indexUser']);
    }

    public function forgotPassword()

    {
        return view($this->view['forgot-password']);
    }

    public function loginUser(LoginRequest $request)
    {
        $this->login = $request->validated();

        if ($this->resolveWeb()) {
            $request->session()->regenerate();
            return $this->handleUserLogin();
        }

        return back()->with('error', __('Tên đăng nhập hoặc mật khẩu không đúng'));
    }

    protected function handleUserLogin()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->intended(route('user.profile.indexUser'))->with('success', __('Đăng nhập thành công'));
        }
    }

    protected function resolveWeb()
    {
        return Auth::guard('web')->attempt($this->login, true);
    }
}
