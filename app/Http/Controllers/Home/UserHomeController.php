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
        SettingRepositoryInterface $settingRepository,
        FlashSaleRepositoryInterface $flashSaleRepository,
    ) {
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
        $flashSale = $this->flashSaleRepository->getFlashSaleId_ValidDay();
        return view($this->view['index'], [
            'flashSale' => $flashSale,
            'title' => $title,
            'meta_desc' => $meta_desc,
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
