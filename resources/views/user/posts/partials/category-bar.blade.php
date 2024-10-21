@php
    $categoryRepository = app()->make(abstract: App\Admin\Repositories\PostCategory\PostCategoryRepository::class);
    $categories = $categoryRepository->getFlatTree();
@endphp

<div id="category-bar">
    <h5 class="title">Chuyên mục</h5>
    <div class="category-list">
        <x-link class="category-item" href="{{ route('user.post.index') }}">
            {{ __('Tất cả') }}
        </x-link>
        @foreach ($categories as $category)
            @if ($category->status == '1')
                <x-link class="category-item" href="{{ route('user.post.fallback', ['slug' => $category->slug]) }}">
                    <img class="category-image" src="{{ asset($category->avatar) }}" alt="{{ $category->name }}">
                    <p class="category-name">{{ $category->name }}</p>
                </x-link>
            @endif
        @endforeach
    </div>
</div>