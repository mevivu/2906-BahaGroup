<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Admin\Http\Resources\Product\ProductEditResource;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Repositories\FlashSale\FlashSaleRepositoryInterface;

class UserHomeController extends Controller
{
    protected FlashSaleRepositoryInterface $flashSaleRepository;
    public function __construct(
        ProductRepositoryInterface   $repository,
        FlashSaleRepositoryInterface $flashSaleRepository,
        )
    {
        parent::__construct();
        $this->repository = $repository;
        $this->flashSaleRepository = $flashSaleRepository;
    }
    public function getView()
    {
        return [
            'index' => 'user.home.index',
            'information' => 'user.information.index',
            'contact' => 'user.contact.index',
        ];
    }
    public function index()
    {
        // params: flash_sale_id
        $flash_sale_id = 2;
        $flashSaleProduct_Rows = $this->flashSaleRepository->getAllFlashSaleProducts_Rows($flash_sale_id);
        $flashSaleProducts = [];
        $on_flash_sale = false;

        foreach ($flashSaleProduct_Rows as $item) {
            $on_flash_sale = true;
            // Get All Flash Sale Products
            $product = $this->repository->loadRelations($this->repository->findOrFail($item->product_id), [
                'categories:id,name',
                'productAttributes' => function ($query) {
                    return $query->with(['attribute.variations', 'attributeVariations:id']);
                },
                'productVariations.attributeVariations'
            ]);
            $product = new ProductEditResource($product);
            $products = (object)[
                'product' => $product,
                'in_stock' => $item->qty,
                'sold' => $item->sold = $item->sold ? $item->sold : 0,
            ];
            array_push($flashSaleProducts, $products);
        }

        return view($this->view['index'], [
            'products' => $flashSaleProducts,
            'on_flash_sale' => $on_flash_sale,
        ]);
    }

    public function information()
    {
        return view($this->view['information']);
    }

    public function contact()
    {
        return view($this->view['contact']);
    }
}
