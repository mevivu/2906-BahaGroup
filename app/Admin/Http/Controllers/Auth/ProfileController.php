<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\ProfileRequest;
use App\Admin\Services\File\FileService;
use App\Enums\User\Gender;

class ProfileController extends Controller
{
    protected FileService $fileService;

    public function __construct(
        FileService $fileService
    ) {
        parent::__construct();
        $this->fileService = $fileService;
    }
    public function getView()
    {
        return [
            'index' => 'admin.auth.profile.index',
            'indexUser' => 'user.auth.profile'
        ];
    }
    public function index()
    {

        $auth = auth('admin')->user();

        return view($this->view['index'], compact('auth'));
    }

    public function indexUser()
    {

        $auth = auth('web')->user();
        $gender = Gender::asSelectArray();
        $breadcrumbs = $this->crums->add(__('Tài khoản'))->getBreadcrumbs();

        return view($this->view['indexUser'], compact('auth', 'gender', 'breadcrumbs'));
    }

    public function update(ProfileRequest $request)
    {
        $data = $request->validated();
        if (isset($data['avatar'])) {
            $data['avatar'] = $this->fileService->uploadAvatar('images', $data['avatar'], null);
        }
        if (auth('admin')->check()) {
            auth('admin')->user()->update($data);
        } elseif (auth('web')->check()) {
            auth('web')->user()->update($data);
        }
        return back()->with('success', __('notifySuccess'));
    }
}
