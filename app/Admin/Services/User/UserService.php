<?php

namespace App\Admin\Services\User;

use  App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Traits\Roles;
use Exception;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Traits\UseLog;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
    use Setup, Roles, UseLog;

    protected array $data;

    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request): object|false
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['username'] = $data['phone'];
            $data['code'] = $this->createCodeUser();
            dd($data);

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

    public function update(Request $request): object|bool
    {

        DB::beginTransaction();
        try {
            $data = $request->validated();

            $user = $this->repository->update($data['id'], $data);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollback();
            $this->logError('Failed to process update user', $e);
            return false;
        }
    }

    public function delete($id): object|bool
    {
        return $this->repository->delete($id);
    }
}
