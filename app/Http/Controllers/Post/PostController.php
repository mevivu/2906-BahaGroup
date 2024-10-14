<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Admin\Repositories\Post\PostRepositoryInterface;
use App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface;
use App\Admin\Services\Post\PostServiceInterface;
use App\Traits\ResponseController;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;

class PostController extends Controller
{
    use ResponseController;

    protected $repository;
    protected $service;
    protected $categoryRepository;
    protected $model;
    protected SettingRepositoryInterface $settingRepository;

    public function __construct(
        PostRepositoryInterface $repository,
        PostServiceInterface $service,
        PostCategoryRepositoryInterface $categoryRepository,
        Post $model,
        SettingRepositoryInterface $settingRepository
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
        $this->categoryRepository = $categoryRepository;
        $this->model = $model;
        $this->settingRepository = $settingRepository;
    }

    public function getView(): array
    {
        return [
            'index' => 'user.posts.index',
            'detail' => 'user.posts.detail',
            'category' => 'user.posts.category',
        ];
    }

    public function getRoute(): array
    {
        return [];
    }

    public function category($id, $slug)
    {
        $query = $this->model->query();
        $posts = $this->model->scopeHasCategory($query, $id)->paginate(4);
        $category = $this->categoryRepository->findOrFail($id);
        if ($category->slug !== $slug) {
            return abort(404);
        }
        $settingsGeneral = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settingsGeneral->where('setting_key', 'post_title')->first()->plain_value;
        $meta_desc = $settingsGeneral->where('setting_key', 'post_meta_desc')->first()->plain_value;
        $breadcrumbs = $this->homeCrums->add(__('Tin tức'))->getBreadcrumbs();
        return view($this->view['index'], compact('posts', 'title', 'meta_desc', 'breadcrumbs'));
    }

    public function detail($slug)
    {
        $post = $this->repository->findByField('slug', $slug);
        if ($post->slug !== $slug) {
            return abort(404);
        }
        $relatedPosts = $this->model->whereHas('categories', function ($query) use ($post) {
            $query->whereIn('category_id', $post->categories->pluck('id'));
        })->where('id', '!=', $post->id)->limit(3)->get();
        return view($this->view['detail'], [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'breadcrumbs' => $this->homeCrums->add(__('Tin tức'), route('user.post.index'))->add(__('Chi tiết bài viết'))->getBreadcrumbs()
        ]);
    }

    public function index(Request $request)
    {
        $query = $this->model->query();
        $posts = $this->model->scopePublished($query)
            ->orderByRaw('is_featured ASC, posted_at DESC')
            ->paginate(4);
        $settingsGeneral = $this->settingRepository->getByGroup([SettingGroup::General]);
        $title = $settingsGeneral->where('setting_key', 'post_title')->first()->plain_value;
        $meta_desc = $settingsGeneral->where('setting_key', 'post_meta_desc')->first()->plain_value;
        $breadcrumbs = $this->homeCrums->add(__('Tin tức'))->getBreadcrumbs();
        return view($this->view['index'], compact('posts', 'title', 'meta_desc', 'breadcrumbs'));
    }
}
