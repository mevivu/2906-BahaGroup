@php
    $categoryRepository = app()->make(App\Admin\Repositories\Category\CategoryRepository::class);
    $categories = $categoryRepository->getFlatTree(5);
    $total = $categories->count();
@endphp
<div class="container shadow-sm bg-white rounded-3">
    <div class="row header-box">
        <div class="col-12 shadow-sm">
            <h4 class="mb-0">Danh mục nổi bật</h4>
            <x-link class="text-category" :href="route('user.product.indexUser')">{{ __('Tất cả sản phẩm') }}</x-link>
        </div>
    </div>
    <div class="row pt-3">
        @foreach ($categories as $category)
            <div class="col-6 col-md-2 text-center">
                <div class="shadow-sm rounded-3">
                <x-link :href="route('user.product.indexUser')">
                    <div class="product_avt">
                        <img src="{{ asset($category->avatar) }}" width="100%" />
                    </div>
                </x-link>
                <p>
                    <x-link :href="route('user.product.indexUser')" class="fs-6 text-dark">
                        {{ $category->name }}
                    </x-link>
                </p>
            </div>
            </div>
        @endforeach
        {{-- 
        @if ($total < 12)
            @if ($total < 6)
                @for ($i = $total; $i < 6; $i++)
                    <div class="col-6 col-md-2 text-center">
                        <x-link>
                            <div class="product_avt">
                                <img src="{{ asset($category->avatar) }}" class="img-fluid" alt="">
                            </div>
                        </x-link>
                        <x-link :href="route('user.product.indexUser')">
                            <p>Sắp diễn ra</p>
                        </x-link>
                    </div>
                @endfor
            @elseif ($total > 6)
                @for ($i = $total; $i < 12; $i++)
                    <x-link>
                        <div class="product_avt">
                            <img src="{{ asset($category->avatar) }}" class="img-fluid" alt="">
                        </div>
                    </x-link>
                    <x-link :href="route('user.product.indexUser')">
                        <p>Sắp diễn ra</p>
                    </x-link>
                @endfor
            @endif
        @endif
        --}}
    </div>
</div>
