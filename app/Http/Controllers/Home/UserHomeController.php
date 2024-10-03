<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;

class UserHomeController extends Controller
{

    protected SettingRepositoryInterface $settingRepository;
    public function __construct(
        SettingRepositoryInterface $settingRepository
    ) {
        parent::__construct();
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
        return view($this->view['index'], compact('title', 'meta_desc'));
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
