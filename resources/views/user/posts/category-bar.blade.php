@php
    $categoryRepository = app()->make(abstract: App\Admin\Repositories\PostCategory\PostCategoryRepository::class);
    $categories = $categoryRepository->getFlatTree();
@endphp

<div class="col-md-3">
    <div class="list-group">
        <a href="{{ route('user.post.index') }}" class="list-group-item list-group-item-action">
            {{ __('Tất cả') }}
        </a>
        @foreach ($categories as $category)
            @if ($category->status == '1')
                <a href="{{ route('user.post.category', ['idCategory' => $category->id, 'slugCategory' => $category->slug]) }}"
                    class="list-group-item list-group-item-action">
                    {{ $category->name }}
                </a>
            @endif
        @endforeach
    </div>
</div>