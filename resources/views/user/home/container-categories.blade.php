@php
    $categoryRepository = app()->make(App\Admin\Repositories\Category\CategoryRepository::class);
    $categories = $categoryRepository->getFlatTree(5);
    $total = $categories->count();
@endphp
<div class="container shadow rounded-3">
    <div class="row header-box">
        <div class="col-12 shadow-sm">
            <h4 class="mb-0">Danh mục nổi bật</h4>
            <x-link class="text-category" :href="route('user.product.indexUser')">{{ __('Tất cả sản phẩm') }}</x-link>
        </div>
    </div>
    <div class="row category-box">
        @foreach ($categories as $category)
            <div class="col-6 col-md-2 d-flex justify-content-center align-items-center category-item">
                <x-link :href="route('user.product.indexUser')">
                    <img style="max-height: 200px; min-height: 200px" src="{{ asset($category->avatar) }}" class="img-fluid" alt="">
                </x-link>
                <x-link :href="route('user.product.indexUser')">
                    <p>{{ $category->name }}</p>
                </x-link>
            </div>
        @endforeach

        @if ($total < 12)
            @if ($total < 6)
                @for ($i = $total; $i < 6; $i++)
                    <div class="col-6 col-md-2 d-flex justify-content-center align-items-center category-item">
                        <x-link>
                            <img style="max-height: 200px; min-height: 200px" src="1" class="img-fluid" alt="">
                        </x-link>
                        <x-link :href="route('user.product.indexUser')">
                            <p>Sắp diễn ra</p>
                        </x-link>
                    </div>
                @endfor
            @elseif ($total > 6)
                @for ($i = $total; $i < 12; $i++)
                    <x-link>
                        <img style="max-height: 200px; min-height: 200px" src="1" class="img-fluid" alt="">
                    </x-link>
                    <x-link :href="route('user.product.indexUser')">
                        <p>Sắp diễn ra</p>
                    </x-link>
                @endfor
            @endif
        @endif

    </div>
</div>
