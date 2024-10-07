<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Admin\Http\Resources\Product\ProductEditResource;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Repositories\FlashSale\FlashSaleRepositoryInterface;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;

class UserHomeController extends Controller
{
    protected SettingRepositoryInterface $settingRepository;
    protected FlashSaleRepositoryInterface $flashSaleRepository;
    public function __construct(
        ProductRepositoryInterface   $repository,
        FlashSaleRepositoryInterface $flashSaleRepository,
        SettingRepositoryInterface $settingRepository,
        )
    {
        parent::__construct();
        $this->repository = $repository;
        $this->flashSaleRepository = $flashSaleRepository;
        $this->settingRepository = $settingRepository;
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
        $settingsGeneral = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settingsGeneral->where('setting_key', 'home_title')->first()->plain_value;
        $meta_desc = $settingsGeneral->where('setting_key', 'home_meta_desc')->first()->plain_value;
        // params: flash_sale_id
        $flash_sale_id = $this->flashSaleRepository->getFlashSaleId_ValidDay();
        $flashSaleProducts = [];
        $on_flash_sale = false;
        
        $flash_sale = $this->flashSaleRepository->getFlashSaleInfo($flash_sale_id);
        if ($flash_sale != null) {
            if (strtotime($flash_sale->end_time) < strtotime(date('Y-m-d H:i:s'))){
                $on_flash_sale = false;
            }
            else {
                $flashSaleProduct_Rows = $this->flashSaleRepository->getAllFlashSaleProducts_Rows($flash_sale_id);

                foreach ($flashSaleProduct_Rows as $item) {
                    $on_flash_sale = true;
                    // Get All Flash Sale Products
                    $product = $this->repository->loadRelations($this->repository->findOrFail($item->product_id), [
                        'categories:id,name',
                        'reviews:rating,content,product_id',
                        'productAttributes' => function ($query) {
                            return $query->with(['attribute.variations', 'attributeVariations:id']);
                        },
                        'productVariations.attributeVariations'
                    ]);
                    $product = new ProductEditResource($product);
                    // Rating calculation
                    $avg_review_rate = 0;
                    $sum_customer_review = count($product->reviews) ? count($product->reviews) : 0;
                    foreach($product->reviews as $review) {
                        $avg_review_rate += $review->rating;
                    }
                    $avg_review_rate = $sum_customer_review != 0 ? $avg_review_rate /= $sum_customer_review : 0;

                    $products = (object)[
                        'product' => $product,
                        'in_stock' => $item->qty,
                        'sold' => $item->sold = $item->sold ? $item->sold : 0,
                        'avgReviewRate' => $avg_review_rate,
                        'sumCustomerReview' => $sum_customer_review,
                    ];
                    array_push($flashSaleProducts, $products);
                }
            }
        }
        
        return view($this->view['index'], [
            'products' => $flashSaleProducts,
            'on_flash_sale' => $on_flash_sale,
            'title' => $title,
            'meta_desc' => $meta_desc,
        ]);
    }

    public function information()
    {
        $settingsGeneral = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settingsGeneral->where('setting_key', 'information_title')->first()->plain_value;
        $meta_desc = $settingsGeneral->where('setting_key', 'information_meta_desc')->first()->plain_value;

        $settingsInformation = $this->settingRepository->getByGroup([SettingGroup::Information]);
        return view($this->view['information'], compact('title', 'meta_desc', 'settingsInformation'));
    }

    public function contact()
    {
        $settings = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settings->where('setting_key', 'contact_title')->first()->plain_value;
        $meta_desc = $settings->where('setting_key', 'contact_meta_desc')->first()->plain_value;

        $settingsFooter = $this->settingRepository->getByGroup([SettingGroup::Footer]);
        $settingsContact = $this->settingRepository->getByGroup([SettingGroup::Contact]);
        return view($this->view['contact'], compact('title', 'meta_desc', 'settingsContact', 'settingsFooter'));
    }
}
