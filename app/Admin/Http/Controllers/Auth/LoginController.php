<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $login;
    public function getView()
    {
        return [
            'index' => 'admin.auth.login',
            'indexUser' => 'user.auth.login'
        ];
    }

    public function index()
    {
        return view($this->view['index']);
    }

    public function indexUser()
    {
        return view($this->view['indexUser']);
    }

    public function login(LoginRequest $request)
    {
        $this->login = $request->validated();

        if ($this->resolveAdmin() || $this->resolveWeb()) {

            $request->session()->regenerate();

            if (Auth::guard('admin')->check()) {
                return redirect()->intended(route('admin.discount.index'))->with('success', __('Đăng nhập thành công'));
            } elseif (Auth::guard('web')->check()) {
                return redirect()->intended(route('user.auth.profile'))->with('success', __('Đăng nhập thành công'));
            }
        }

        return back()->with('error', __('Tên đăng nhập hoặc mật khẩu không đúng'));
    }

    protected function resolveAdmin()
    {
        return Auth::guard('admin')->attempt($this->login, true);
    }

    protected function resolveWeb()
    {
        return Auth::guard('web')->attempt($this->login, true);
    }
}
