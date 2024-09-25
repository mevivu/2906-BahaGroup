<?php

namespace App\Views;

use App\Admin\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\View\Component;
use App\Admin\Traits\GetConfig;

class Header extends Component
{
    use GetConfig;

    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function render()
    {
        $categories = $this->categoryRepository->getFlatTree();
        $parentCategories = $this->categoryRepository->getParentCategory();
        return view('components.layouts.header', compact('categories', 'parentCategories'));
    }
}
