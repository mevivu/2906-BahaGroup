<?php

namespace App\Admin\Services\Auth;

use App\Admin\Repositories\Auth\SigninRepositoryInterface;
use App\Admin\Services\Auth\SigninServiceInterface;
use App\Admin\Traits\Setup;
use App\Mail\Authentication;
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
}
