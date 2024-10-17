<?php

namespace App\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\ForgotPasswordRequest;
use App\Admin\Http\Requests\Auth\LoginRequest;
use App\Admin\Http\Requests\Auth\OauthReqest;
use App\Admin\Http\Requests\Auth\RegisterRequest;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Traits\Setup;
use App\Enums\DefaultActiveStatus;
use App\Enums\User\Gender;
use App\Mail\Authentication;
use App\Mail\ForgotPass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use Setup;
    private $login;

    protected $repository;
    protected $service;

    protected $view;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->view = $this->getView();
    }

    public function getView()
    {
        return [
            'indexUser' => 'user.auth.login',
            'forgot-password' => 'user.auth.forgot-password',
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

    public function forgotPasswordSend(ForgotPasswordRequest $request)
    {
        $data = $request->validated();
        $user = $this->repository->findByField('email', $data['email']);

        if ($user) {

            $user['token_get_password'] = Str::random(64);
            $user['token_expiration'] = now()->addMinutes(5);
            $user['url'] = route('user.auth.resetPassword', ['token_get_password' => $user['token_get_password']]);
            $this->repository->update($user['id'], ['token_get_password' => $user['token_get_password'], 'token_expiration' => $user['token_expiration']]);

            Mail::to($data['email'])->send(new ForgotPass($user));
            return back()->with('success', __('Mã xác minh đã được gửi, vui lòng kiểm tra email'));
        }

        return back()->with('error', __('Email chưa được đăng ký. Vui lòng đăng ký!'));
    }

    public function resetPassword(Request $request)
    {
        $token = $request->query('token_get_password');
        if ($this->checkToken($token) === true) {
            return view('user.auth.change-forgot', compact('token'));
        }

        return redirect()->route('user.auth.indexUser')->with('error', __('Token đã hết hạn'));
    }

    public function checkToken(string $token)
    {
        $user = $this->repository->findByField('token_get_password', $token);
        if ($user) {
            if ($user['token_expiration'] > now()) {
                return true;
            }
        }
        return false;
    }

    public function changePassword(ForgotPasswordRequest $request)
    {
        $data = $request->all();
        $user = $this->repository->findByField('token_get_password', $data['token_get_password']);
        $user['password'] = Hash::make($data['password']);
        $user['token_get_password'] = null;
        $user['token_expiration'] = null;
        $this->repository->update($user['id'], ['password' => $user['password'], 'token_get_password' => $user['token_get_password'], 'token_expiration' => $user['token_expiration']]);
        return redirect()->route('user.auth.indexUser')->with('success', __('Thay đổi mật khẩu thành công.'));
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
            if (auth('web')->user()->active == DefaultActiveStatus::UnActive->value) {
                Auth::guard('web')->logout();
                return redirect()->route('user.auth.indexUser')->with('error', __('Tài khoản của bạn chưa được kích hoạt'));
            }
            return redirect()->intended(route('user.profile.indexUser'))->with('success', __('Đăng nhập thành công'));
        }
    }

    protected function resolveWeb()
    {
        return Auth::guard('web')->attempt($this->login, true);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['code'] = $this->createCodeUser();
        $data['password'] = Hash::make($data['password']);
        $data['oauth'] = random_int(1000000, 9999999);
        $data['active'] = DefaultActiveStatus::UnActive;
        $data['gender'] = Gender::Female;

        if ($this->repository->create($data)) {
            Mail::to($data['email'])->send(new Authentication($data));
            return redirect()->intended(route('user.auth.oauth', ['email' => $data['email']]))->with('success', __('Đăng ký thành công. Vui lòng kiểm tra email để kích hoạt tài khoản.'));
        }

        return back()->with('error', __('Đăng ký thất bại'));
    }

    public function oauth(OauthReqest $request)
    {
        return view('user.auth.oauth_verification', ['email' => $request->query('email')]);
    }

    public function oauthChange(OauthReqest $request)
    {
        $data = $request->validated();
        $user = $this->repository->findByField('email', $data['email']);

        if ($user && $user['oauth'] === intval($data['oauth'])) {
            $this->repository->update($user['id'], ['active' => 1, 'oauth' => null]);
            return redirect()->route('user.auth.indexUser')->with('success', __('Xác thực tài khoản thành công'));
        }

        return back()->with('error', __('Mã OTP xác thực tài khoản không đúng'));
    }
}
