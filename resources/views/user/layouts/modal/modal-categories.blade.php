<div style="{{ Route::currentRouteName() != 'user.index' ? 'margin-top: -3.4em' : '' }}" class="row container container-fluid p-0 absolute-category">
    <div style="margin-left: -16px;" id="side-bar" class="col-3 {{ Route::currentRouteName() != 'user.index' ? 'd-none' : '' }}">
        <ul class="menu">
            @foreach ($parentCategories as $category)
                <li>
                    <x-link class="text-category" :href="route('user.product.indexUser', ['category_id' => $category->id])">
                        <i class="{{ $category->icon }}"></i>{{ $category->name }} <i class="ti ti-chevron-right"></i>
                    </x-link>
                    @if(isset($category->children[0]))
                    <div class="submenu mega-menu">
                        @foreach ($category->children as $item)
                                <div class="mega-column">
                                    <x-link class="text-black" :href="route('user.product.indexUser', ['category_id' => $item->id])">
                                        <h3>{{ $item->name }}</h3>
                                    </x-link>
                                    @foreach ($item->children as $children)
                                        <ul class="sub-category">
                                            <li>
                                                <x-link class="text-black" :href="route('user.product.indexUser', ['category->id' => $children->id])">
                                                    {{ $children->name }}
                                                </x-link>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                        @endforeach
                    </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
