<?php

namespace App\Api\V1\Services\Auth;

use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Traits\Roles;
use App\Api\V1\Services\Auth\AuthServiceInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Enums\User\Gender;
use App\Traits\UseLog;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AuthService implements AuthServiceInterface
{
    use Setup, Roles, UseLog;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    protected $instance;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['username'] = $data['phone'];
            $data['code'] = $this->createCodeUser();
            $data['gender'] = Gender::Female;
            $data['password'] = bcrypt($data['password']);
            $data['token_active_account'] = $this->uniqidReal();
            $data['active'] = 0;

            $user = $this->repository->create($data);
            $roles = $this->getRoleCustomer();
            $this->repository->assignRoles($user, [$roles]);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollback();
            $this->logError('Failed to process create user', $e);
            return false;
        }
    }

    public function update(Request $request)
    {

        $this->data = $request->validated();

        if (isset($this->data['password']) && $this->data['password']) {
            $this->data['password'] = bcrypt($this->data['password']);
        } else {
            unset($this->data['password']);
        }

        return $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function updateTokenPassword(Request $request)
    {
        $user  = $this->repository->findByField('email', $request->input('email'));
        $this->data['token_get_password'] = $this->generateTokenGetPassword();
        $this->instance['user'] = $this->updateObject($user, $this->data);
        return $this;
    }

    public function generateRouteGetPassword($routeName)
    {
        $this->instance['url'] = URL::temporarySignedRoute(
            $routeName,
            now()->addMinutes(30),
            [
                'token' => $this->data['token_get_password'],
                'code' => $this->instance['user']->code
            ]
        );
        return $this;
    }

    public function generateRouteActivateAccount($routeName)
    {
        $this->instance['url'] = URL::temporarySignedRoute(
            $routeName,
            now()->addMinutes(30), // Thời hạn liên kết, có thể điều chỉnh
            [
                'token' => $this->data['token_active_account'],
                'code' => $this->instance['user']->code,
            ]
        );
        return $this;
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function updateObject($user, $data)
    {
        $user->update($data);
        return $user;
    }
}
