<?php

namespace App\Admin\Http\Controllers\FlashSale;

use App\Admin\DataTables\FlashSale\FlashSaleDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\FlashSale\FlashSaleRequest;
use App\Admin\Repositories\FlashSale\FlashSaleRepositoryInterface;
use App\Admin\Services\FlashSale\FlashSaleServiceInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class FlashSaleController extends Controller
{
    protected $repository;

    public function __construct(
        FlashSaleRepositoryInterface $repository,
        FlashSaleServiceInterface    $service,
    ) {

        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(): array
    {

        return [
            'index' => 'admin.flash_sales.index',
            'create' => 'admin.flash_sales.create',
            'edit' => 'admin.flash_sales.edit',
            'add_item_product' => 'admin.flash_sales.partials.add-item-product',
        ];
    }

    public function getRoute(): array
    {

        return [
            'index' => 'admin.flashsale.index',
            'create' => 'admin.flashsale.create',
            'edit' => 'admin.flashsale.edit',
        ];
    }

    public function index(FlashSaleDataTable $dataTable)
    {

        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('listFlashSale'))
        ]);
    }


    public function create(): Factory|View|Application
    {

        return view($this->view['create'], []);
    }


    public function store(FlashSaleRequest $request)
    {
        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['index'])->with('success', __('notifySuccess'));
        }
        return to_route($this->route['index'])->with('error', __('notifyFail'));
    }

    /**
     * @throws Exception
     */
    public function edit($id): Factory|View|Application
    {
        $instance = $this->repository->findOrFail($id);

        return view(
            $this->view['edit'],
            [
                'instance' => $instance
            ],
        );
    }

    public function update(FlashSaleRequest $request)
    {
        $response = $this->service->update($request);
        if ($response) {
            return to_route($this->route['index'])->with('success', __('notifySuccess'));
        }
        return to_route($this->route['index'])->with('error', __('notifyFail'));
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        if ($response) {
            return to_route($this->route['index'])->with('success', __('notifySuccess'));
        }
        return to_route($this->route['index'])->with('error', __('notifyFail'));
    }

    public function addProduct(FlashSaleRequest $request): JsonResponse
    {
        $product = $this->service->addProduct($request);

        if (!$product) {
            return response()->json([
                'status' => 400,
                'message' => __('notifyFail')
            ], 400);
        }
        $response = view($this->view['add_item_product'], compact('product'))->render();

        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => $response
        ], 200);
    }

    public function deleteDetail($id)
    {
        if ($this->repository->deleteDetail($id)) {
            return response()->json([
                'status' => 200,
                'msg' => __('notifySuccess')
            ], 200);
        }
        return response()->json([
            'status' => 400,
            'msg' => __('notifyFail')
        ], 400);
    }
}
