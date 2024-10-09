<?php

namespace App\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\LoginRequest;
use App\Admin\Http\Requests\Auth\OauthReqest;
use App\Admin\Http\Requests\Auth\RegisterRequest;
use App\Admin\Repositories\Auth\SigninRepositoryInterface;
use App\Admin\Services\Auth\SigninServiceInterface;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $login;

    protected $repository;
    protected $service;

    protected $view;

    public function __construct(SigninRepositoryInterface $repository, SigninServiceInterface $service)
    {
        $this->repository = $repository;
        $this->service = $service;

        $this->view = $this->getView();
    }

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

    public function signinUser(RegisterRequest $request)
    {
        $this->validateLogin($request);
        return $this->service->register($this->login);
    }

    protected function validateLogin(RegisterRequest $request)
    {
        $this->login = $request->validated();
    }

    public function oauth(OauthReqest $request)
    {
        return view('user.auth.oauth_verification', ['email' => $request->query('email')]);
    }

    public function oauthChange(OauthReqest $request)
    {
        $this->login = $request->validated();
        return $this->service->oauth($this->login);
    }
}
