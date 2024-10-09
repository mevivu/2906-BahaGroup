<?php

namespace App\Admin\DataTables\Product;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Repositories\Product\ProductRepositoryInterface;

class ProductDataTable extends BaseDataTable
{
    protected $nameTable = 'productTable';
    protected CategoryRepositoryInterface $repoCat;
    protected $productIds;
    public function __construct(
        ProductRepositoryInterface $repository,
        CategoryRepositoryInterface $repoCat,
        $productIds = [],
    ) {
        $this->repository = $repository;
        $this->repoCat = $repoCat;
        parent::__construct();
        $this->productIds = $productIds;
    }

    public function setView(): void
    {
        $this->view = [
            'action' => 'admin.products.datatable.action',
            'avatar' => 'admin.products.datatable.avatar',
            'edit_link' => 'admin.products.datatable.editlink',
            'instock' => 'admin.products.datatable.instock',
            'price' => 'admin.products.datatable.price',
            'categories' => 'admin.products.datatable.categories',
        ];
    }

    public function setColumnSearch(): void
    {
        $this->columnAllSearch = [1, 2, 4, 5];

        $this->columnSearchDate = [5];

        $this->columnSearchSelect = [

            [
                'column' => 2,
                'data' => [0 => 'Hết hàng', 1 => 'Còn hàng']
            ],
        ];
    }

    public function query()
    {
        $query = $this->repository->getQueryBuilderWithRelations();

        if (!empty($this->productIds)) {
            $query->whereIn('id', $this->productIds);
        }

        return $query;
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.product', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['edit_link'],
            'avatar' => $this->view['avatar'],
            'in_stock' => $this->view['instock'],
            'categories' => $this->view['categories'],
            'created_at' => '{{ format_date($created_at) }}',
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'price' => $this->view['price'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['action', 'avatar', 'name', 'in_stock', 'price', 'categories'];
    }

    protected function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'categories' => function ($query, $keyword) {
                $query->whereHas('categories', function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
