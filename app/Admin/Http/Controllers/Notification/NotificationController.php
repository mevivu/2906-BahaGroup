<?php

namespace App\Admin\Http\Controllers\Notification;

use App\Admin\DataTables\Notification\NotificationDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Notification\NotificationRequest;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Services\Notification\NotificationServiceInterface;
use App\Enums\Notification\NotificationStatus;
use App\Enums\Notification\NotificationType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NotificationController extends Controller
{
    protected $driverRepository;
    protected $storeRepository;
    protected $userRepository;

    public function __construct(
        NotificationRepositoryInterface $repository,
        UserRepositoryInterface $userRepository,
        NotificationServiceInterface    $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    public function getView(): array
    {

        return [
            'index' => 'admin.notifications.index',
            'create' => 'admin.notifications.create',
            'edit' => 'admin.notifications.edit'
        ];
    }

    public function getRoute(): array
    {

        return [
            'index' => 'admin.notification.index',
            'create' => 'admin.notification.create',
            'edit' => 'admin.notification.edit',
        ];
    }

    public function index(NotificationDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], []);
    }

    public function create(): View|Application
    {
        return view($this->view['create'], [
            'types' => NotificationType::asSelectArray(),
            'status' => NotificationStatus::asSelectArray(),
        ]);
    }
    public function store(NotificationRequest $request)
    {
        $response = $this->service->store($request);
        if ($response) {
            return redirect()->route($this->route['index'])->with('success', __('notifySuccess'));
        }
        return redirect()->route($this->route['create'])->with('error', __('notifyFail'));
    }


    public function edit($id): View|Application
    {
        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'types' => NotificationType::asSelectArray(),
                'status' => NotificationStatus::asSelectArray(),
                'notification' => $response,
            ],
        );
    }

    public function update(NotificationRequest $request): RedirectResponse
    {
        $response = $this->service->update($request);
        if ($response) {
            return back()->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'));
    }


    public function delete($id): RedirectResponse
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
