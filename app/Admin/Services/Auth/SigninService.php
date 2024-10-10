<?php

namespace App\Admin\Services\Auth;

use App\Admin\Repositories\Auth\SigninRepositoryInterface;
use App\Admin\Services\Auth\SigninServiceInterface;
use App\Admin\Traits\Setup;
use App\Mail\Authentication;
use App\Mail\ForgotPass;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SigninService implements SigninServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(SigninRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function register(array $data = [])
    {
        if (!$this->repository->findByEmail(['email' => $data['email']]) == null) {
            return back()->with('error', __('Email đã đăng ký. Vui lòng đăng ký lại!'));
        }

        $data['code'] = $this->createCodeUser();
        $data['slug'] = Str::slug($data['fullname']);
        $data['password'] = Hash::make($data['password']);
        $data['oauth'] = random_int(1000000, 9999999);

        if ($this->repository->signin($data)) {
            Mail::to($data['email'])->send(new Authentication($data));
            return redirect()->intended(route('user.auth.oauth', ['email' => $data['email']]))->with('success', __('Đăng ký thành công. Vui lòng kích hoạt email.'));
        }

        return back()->with('error', __('Địa chỉ mail hoặc mật khẩu không đúng'));
    }

    public function oauth(array $data = [])
    {
        $this->data = $this->repository->findByEmail(['email' => $data['email']]);

        if ($this->data && $this->data['oauth'] === intval($data['oauth'])) {
            $this->repository->update($this->data['id'], ['active' => 1, 'oauth' => null,]);
            return redirect()->route('user.auth.indexUser')->with('success', __('Xác thực tài khoản thành công'));
        }

        return back()->with('error', __('Mã Oauth xác thực tài khoản không đúng'));
    }

    public function forgotPassword(array $data = [])
    {
        $this->data = $this->repository->findByEmail(['email' => $data['email']]);

        if ($this->data) {

            $this->data['token_get_password'] = Str::random(64);
            $this->data['token_expiration'] = now()->addMinutes(5);
            $this->data['url'] = route('user.auth.resetPassword', ['token_get_password' => $this->data['token_get_password']]);
            $this->repository->update($this->data['id'], ['token_get_password' => $this->data['token_get_password'], 'token_expiration' => $this->data['token_expiration']]);

            Mail::to($data['email'])->send(new ForgotPass($this->data));
            return back()->with('success', __('Vui lòng kiểm tra email'));
        }

        return back()->with('error', __('Email chưa được đăng ký. Vui lòng đăng ký!'));
    }

    public function checkToken(string $token)
    {
        $this->data = $this->repository->findByToken($token);

        if ($this->data) {
            if ($this->data['token_expiration'] > now()) {
                return true;
            }
        }

        return false;
    }

    public function changePassword(array $data = [])
    {
        $this->data = $this->repository->findByToken($data['token_get_password']);
        $this->data['password'] = Hash::make($data['password']);
        $this->data['token_get_password'] = null;
        $this->data['token_expiration'] = null;
        $this->repository->update($this->data['id'], ['password' => $this->data['password'], 'token_get_password' => $this->data['token_get_password'], 'token_expiration' => $this->data['token_expiration']]);
        return redirect()->route('user.auth.indexUser')->with('success', __('Thay đổi mật khẩu thành công.'));
    }
}