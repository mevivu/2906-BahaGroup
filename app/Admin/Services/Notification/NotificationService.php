<?php

namespace App\Admin\Services\Notification;

use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Traits\AuthService;
use App\Enums\Notification\NotificationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationService implements NotificationServiceInterface
{
    use AuthService;

    protected $data;

    protected $repository;
    private UserRepositoryInterface $userRepository;
    private AdminRepositoryInterface $adminRepository;

    public function __construct(
        NotificationRepositoryInterface $repository,
        UserRepositoryInterface        $userRepository,
        AdminRepositoryInterface        $adminRepository,
    ) {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->adminRepository = $adminRepository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        try {
            DB::beginTransaction();
            if ($this->data['type'] == NotificationType::All->value) {
                $users = $this->userRepository->getAll();
                $admins = $this->adminRepository->getAll();
                unset($this->data['type']);
                foreach ($admins as $admin) {
                    $this->data['admin_id'] = $admin->id;
                    $this->repository->create($this->data);
                    unset($this->data['admin_id']);
                }
                foreach ($users as $user) {
                    $this->data['user_id'] = $user->id;
                    $this->repository->create($this->data);
                }
            } else {
                unset($this->data['type']);
                foreach ($this->data['user_id'] as $userId) {
                    $this->data['user_id'] = $userId;
                    $this->repository->create($this->data);
                }
            }
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return false;
        }
    }

    public function update(Request $request): object|bool
    {

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id): object|bool
    {
        return $this->repository->delete($id);
    }
}
