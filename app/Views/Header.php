<?php

namespace App\Views;

use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\View\Component;
use App\Admin\Traits\GetConfig;

use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;

class Header extends Component
{
    use GetConfig;

    protected CategoryRepositoryInterface $categoryRepository;

    protected SettingRepositoryInterface $settingRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, SettingRepositoryInterface $settingRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->settingRepository = $settingRepository;
    }

    public function render()
    {
        $categories = $this->categoryRepository->getFlatTree();
        $parentCategories = $this->categoryRepository->getParentCategory();
        $settingsGeneral = $this->settingRepository->getByGroup([SettingGroup::General]);
        return view('components.layouts.header', compact('categories', 'parentCategories', 'settingsGeneral'));
    }
}
