<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Admin\Repositories\Post\PostRepositoryInterface;
use App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface;
use App\Admin\Services\Post\PostServiceInterface;
use App\Traits\ResponseController;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    use ResponseController;

    protected $repository;
    protected $service;
    protected $categoryRepository;

    protected $model;

    public function __construct(
        PostRepositoryInterface $repository,
        PostServiceInterface $service,
        PostCategoryRepositoryInterface $categoryRepository,
        Post $model,
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
        $this->categoryRepository = $categoryRepository;
        $this->model = $model;
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
        return [
        ];
    }

    public function category($id, $slug)
    {
        $query = $this->model->query();
        $posts = $this->model->scopeHasCategory($query, $id)->paginate(10);
        $category = $this->categoryRepository->findOrFail($id);
        if ($category->slug !== $slug) {
            return abort(404);
        }
        return view($this->view['index'], compact('posts'));
    }

    public function detail($id, $slug)
    {
        $post = $this->repository->findOrFailWithRelations($id, ['categories']);
        if ($post->slug !== $slug) {
            return abort(404);
        }
        $relatedPosts = $this->model->whereHas('categories', function ($query) use ($post) {
            $query->whereIn('category_id', $post->categories->pluck('id'));
        })->where('id', '!=', $post->id)->limit(4)->get();
        return view($this->view['detail'], [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    public function index()
    {
        $query = $this->model->query();
        $posts = $this->model->scopePublished($query)
            ->orderByRaw('is_featured ASC, posted_at DESC')
            ->paginate(10);

        return view($this->view['index'], compact('posts'));
    }
}
