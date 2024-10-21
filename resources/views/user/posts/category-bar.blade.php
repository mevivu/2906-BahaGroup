@php
    $categoryRepository = app()->make(abstract: App\Admin\Repositories\PostCategory\PostCategoryRepository::class);
    $categories = $categoryRepository->getFlatTree();
@endphp

<div class="col-md-3">
    <div id="category-bar">
        <h5 class="category-bar-title">Chuyên mục</h5>
        <div class="divider"></div>
        <div class="category-list">
            <a class="category-item" href="{{ route('user.post.index') }}" class="">
                {{ __('Tất cả') }}
            </a>
            @foreach ($categories as $category)
                @if ($category->status == '1')
                    <a href="{{ route('user.post.fallback', ['slug' => $category->slug]) }}" class="category-item">
                        {{ $category->name }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>