<?php

namespace App\Admin\Http\Controllers\Review;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Review\ReviewRepositoryInterface;
use App\Admin\Services\Review\ReviewServiceInterface;
use App\Admin\DataTables\Review\ReviewDataTable;
use App\Admin\Http\Requests\Review\ReviewRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Admin\Traits\AuthService;
use App\Traits\ResponseController;

class ReviewController extends Controller
{
    use ResponseController, AuthService;
    public function __construct(
        ReviewRepositoryInterface $repository,
        ReviewServiceInterface $service
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }
    public function getView(): array
    {
        return [
            'index' => 'admin.reviews.index',
            'create' => 'admin.reviews.create',
            'edit' => 'admin.reviews.edit',
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.review.index',
            'create' => 'admin.review.create',
            'edit' => 'admin.review.edit',
            'delete' => 'admin.review.delete',
        ];
    }

    public function index(ReviewDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], []);
    }
    public function create(): Factory|View|Application
    {
        return view($this->view['create']);
    }
    public function store(ReviewRequest $request): RedirectResponse
    {
        $instance = $this->service->store($request);
        if ($instance) {
            return to_route($this->route['edit'], $instance->id);
        }
        return back()->with('error', __('notifyFail'));
    }
    public function edit($id): Factory|View|Application
    {
        $instance = $this->repository->findOrFail($id);
        return view($this->view['edit'], compact('instance'));
    }
    public function update(ReviewRequest $request)
    {
        $review = $this->repository->find($request->id);

        if (!$review) {
            return back()->with('error', __('Review not found.'));
        }

        $review->fill($request->validated());

        if ($review->save()) {
            return back()->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'));
    }

    public function delete($id): RedirectResponse
    {
        $response = $this->service->delete($id);
        return $this->handleDeleteResponse($response, $this->route['index']);
    }
}
