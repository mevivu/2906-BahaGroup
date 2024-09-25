<?php

namespace App\Views;

use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\View\Component;
use App\Admin\Traits\GetConfig;

class Footer extends Component
{
    use GetConfig;

    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function render()
    {
        $parentCategories = $this->categoryRepository->getParentCategory();
        return view('components.layouts.footer', compact('parentCategories'));
    }
}
