<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Admin\Http\Resources\Product\ProductEditResource;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Repositories\FlashSale\FlashSaleRepositoryInterface;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Category\HomeSliderOption;
use App\Enums\Setting\SettingGroup;

class UserHomeController extends Controller
{
    protected SettingRepositoryInterface $settingRepository;
    protected FlashSaleRepositoryInterface $flashSaleRepository;
    protected CategoryRepositoryInterface $categoryRepository;
    public function __construct(
        ProductRepositoryInterface   $repository,
        SettingRepositoryInterface $settingRepository,
        FlashSaleRepositoryInterface $flashSaleRepository,
        CategoryRepositoryInterface $categoryRepository,
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->flashSaleRepository = $flashSaleRepository;
        $this->settingRepository = $settingRepository;
        $this->categoryRepository = $categoryRepository;
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
        $flashSale = $this->flashSaleRepository->getFlashSaleId_ValidDay();
        $homeSliderCategory1 = $this->categoryRepository->getBy(['is_home_slider_1' => HomeSliderOption::Active]);
        $homeSliderCategory2 = $this->categoryRepository->getBy(['is_home_slider_2' => HomeSliderOption::Active]);
        return view($this->view['index'], [
            'flashSale' => $flashSale,
            'title' => $title,
            'meta_desc' => $meta_desc,
            'settingsGeneral' => $settingsGeneral,
            'homeSliderCategory1' => $homeSliderCategory1,
            'homeSliderCategory2' => $homeSliderCategory2,
        ]);
    }

    public function information()
    {
        $settingsGeneral = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settingsGeneral->where('setting_key', 'information_title')->first()->plain_value;
        $meta_desc = $settingsGeneral->where('setting_key', 'information_meta_desc')->first()->plain_value;
        $breadcrumbs = $this->homeCrums->add(__('Giới thiệu'))->getBreadcrumbs();

        $settingsInformation = $this->settingRepository->getByGroup([SettingGroup::Information]);
        return view($this->view['information'], compact('title', 'meta_desc', 'settingsInformation', 'breadcrumbs'));
    }

    public function contact()
    {
        $settings = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settings->where('setting_key', 'contact_title')->first()->plain_value;
        $meta_desc = $settings->where('setting_key', 'contact_meta_desc')->first()->plain_value;
        $breadcrumbs =  $this->homeCrums->add(__('Liên hệ'))->getBreadcrumbs();

        $settingsFooter = $this->settingRepository->getByGroup([SettingGroup::Footer]);
        $settingsContact = $this->settingRepository->getByGroup([SettingGroup::Contact]);
        return view($this->view['contact'], compact('title', 'meta_desc', 'settingsContact', 'settingsFooter', 'breadcrumbs'));
    }
}
