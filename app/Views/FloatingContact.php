<?php

namespace App\Views;

use Illuminate\View\Component;
use App\Admin\Traits\GetConfig;

use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;

class FloatingContact extends Component
{
    use GetConfig;

    protected SettingRepositoryInterface $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function render()
    {
        $settingsContact = $this->settingRepository->getByGroup([SettingGroup::Contact]);
        return view('components.floating-contact', compact('settingsContact'));
    }
}
