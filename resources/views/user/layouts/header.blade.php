<!-- Main Header -->
<div id="top-bar" class="pt-1 pb-1 shadow-sm">
    <div class="container p-0">
        <p class="m-0 fs-12">Miễn phí vận chuyển trong
            <span class="text-success fw-bold">Ngày của Baha.</span>
        </p>
    </div>
</div>

<div id="top-header" class="d-flex align-items-center justify-content-center wrap-nav">
    <div class="container">
        <div class="row pt-2 pb-2">
            <!-- Logo -->
            <div class="col-3 d-flex align-items-center">
                <x-link :href="route('user.index')">
                    <img style="max-height: 80px" class="img-fluid" src="{{ asset('public/user/assets/images/logo-ngang.png') }}"
                        alt="Baha">
                </x-link>
            </div>
            <!-- Search Bar -->
            <div class="col-6 d-flex justify-content-center align-items-center">
                <div class="input-group">
                    <x-button class="btn-outline-secondary dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Tất cả</x-button>
                    <ul style="cursor: pointer" class="dropdown-menu search">
                        <li class="dropdown-item selected"><x-link class="text-category" :href="route('user.product.indexUser')">Tất cả</x-link></li>
                        @foreach ($categories as $category)
                            <li class="dropdown-item selected"><x-link class="text-category" :href="route('user.product.indexUser', ['category_id' => $category->id])">{{ $category->name }}</x-link></li>
                        @endforeach
                    </ul>
                    <input type="text" class="form-control" placeholder="Nhập từ khóa bạn muốn tìm kiếm..." aria-label="Text input with dropdown button">
                    <x-button type="submit" class="button-search"><i class="ti ti-search"></i></x-button>
                </div>
            </div>
            <!-- Cart Icon -->
            <div class="col-3 d-flex justify-content-center align-items-center">
                @if (!auth('web')->user())
                    <div class="me-5 pe-"><a class="top-item text-black" href="{{ route('user.auth.indexUser') }}">Đăng nhập</a></div>
                @else
                <div class="me-5 pe- position-relative">
                    <a class="top-item text-black" href="{{ route('user.profile.indexUser') }}">Hi {{ auth('web')->user()->fullname }}</a>
                    <div class="dropdown-menu" id="userDropdown">
                        <a class="dropdown-item" href="{{ route('user.order.indexUser') }}">Đơn hàng</a>
                        <a class="dropdown-item" href="{{ route('user.profile.indexUser') }}">Tài khoản</a>
                        <a class="dropdown-item" href="{{ route('user.password.indexUser') }}">Mật khẩu</a>
                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalLogout">{{ __('Đăng xuất') }}</a>
                    </div>
                </div>
                @endif
                <div class="position-relative">
                    <i onclick="location.href='{{ route('user.cart.index' )}}';" style="font-size: 2em;cursor: pointer;" class="fa fa-shopping-cart"></i>
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="left: 100% !important;">
                        @if (auth('web')->user())
                            {{ auth('web')->user()->shopping_cart()->sum('qty') }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<div id="navbar" class="">
    <div class="d-flex align-items-center justify-content-center wrap-nav" style="background-color: #1c5639;">
        <div class="row container">
            <!-- Categories Menu -->
            <div style="cursor: pointer; margin-left: -16px" onclick="showTabContent()" class="col-3 d-flex align-items-center widget d-none d-xl-flex">
                <h6 class="m-0 d-flex align-items-center" style="height: 45px;">
                    <i class="ti ti-list px-2"></i>Tất cả danh mục
                </h6><br>
                <ul id="menu-1-TQYyg" class="nav-menu"></ul>
            </div>

            <!-- Main Navigation Links -->
            <div class="col-9 d-flex align-items-center d-none d-xl-flex">
                <ul class="nav">
                    <li class="nav-item default-font-size">
                        <x-link :href="route('user.index')">Trang chủ</x-link>
                    </li>
                    <li class="nav-item default-font-size">
                        <x-link :href="route('user.information')">Giới thiệu</x-link>
                    </li>
                    <li class="nav-item default-font-size">
                        <x-link :href="route('user.product.indexUser')">Sản phẩm</x-link>
                    </li>
                    <li class="nav-item default-font-size">
                        <x-link :href="route('user.contact')">Liên hệ</x-link>
                    </li>
                    <li class="nav-item default-font-size">
                        <x-link :href="route('user.product.saleLimited')">Khuyến mãi giới hạn</x-link>
                    </li>
                    <li class="nav-item default-font-size">
                        <x-link :href="route('user.post.index')">Tin tức</x-link>
                    </li>
                </ul>
            </div>
            <!-- NavBar Responsive-->
            <div class="nav-responsive row container d-xl-none d-flex">
                <button class="col-3 btn d-xl-none d-block" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="ti ti-list default-double-font-size"></i>
                </button>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <x-link :href="route('user.index')">
                        <img style="max-height: 40px" src="{{ asset('public/user/assets/images/logo-ngang.png') }}"
                            alt="Baha" class="img-fluid">
                    </x-link>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center cart">
                    <div class="position-relative">
                        <i onclick="location.href='{{ route('user.cart.index' )}}';" style="font-size: 2em;cursor: pointer;" class="fa fa-shopping-cart"></i>
                        <span id="cart-count-mobile" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="left: 100% !important;">
                            @if (auth('web')->user())
                                {{ auth('web')->user()->shopping_cart()->sum('qty') }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <!-- Offcanvas Menu -->
            <div class="offcanvas offcanvas-start d-xl-none d-block" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu"
                                type="button" role="tab" aria-controls="menu" aria-selected="true">
                                <i class="ti ti-list"></i> Menu
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="category-tab" data-bs-toggle="tab" data-bs-target="#category"
                                type="button" role="tab" aria-controls="category" aria-selected="false">
                                <i class="ti ti-list"></i> Danh mục
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                            <ul class="nav">
                                <li class="nav-item">
                                    <x-link :href="route('user.index')">Trang chủ</x-link>
                                </li>
                                <li class="nav-item">
                                    <x-link :href="route('user.information')">Giới thiệu</x-link>
                                </li>
                                <li class="nav-item">
                                    <x-link :href="route('user.product.indexUser')">Sản phẩm</x-link>
                                </li>
                                <li class="nav-item">
                                    <x-link :href="route('user.contact')">Liên hệ</x-link>
                                </li>
                                <li class="nav-item">
                                    <x-link :href="route('user.product.saleLimited')">Khuyến mãi giới hạn</x-link>
                                </li>
                                <li class="nav-item default-font-size">
                                    <x-link :href="route('user.post.index')">Tin tức</x-link>
                                </li>
                                @if (auth('web')->user())
                                    <li class="nav-item">
                                        <x-link :href="route('user.order.indexUser')">Đơn hàng</x-link>
                                    </li>
                                    <li class="nav-item">
                                        <x-link :href="route('user.profile.indexUser')">Tài khoản</x-link>
                                    <li class="nav-item">
                                        <x-link :href="route('user.password.indexUser')">Mật khẩu</x-link>
                                    </li>
                                    <li class="nav-item">
                                        <x-link data-bs-toggle="modal" data-bs-target="#modalLogout" :href="route('user.product.saleLimited')">Đăng xuất</x-link>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
                            <ul class="menu">
                                @foreach ($parentCategories as $category)
                                    <li class="mt-2">
                                        <div class="ms-3 d-flex fs-6">
                                            <x-link class="text-black col-6" href="{{ route('user.product.indexUser', ['category_id' => $category->id]) }}">
                                                <i class="{{ $category->icon }} me-2 fs-4"></i>{{ $category->name }}
                                            </x-link>
                                            <i class="ti ti-chevron-right col-6 text-end" data-bs-toggle="collapse"
                                                    href="#collapseExample-{{ $category->id }}" role="button" aria-expanded="false"
                                                    aria-controls="collapseExample-{{ $category->id }}"></i>
                                        </div>
                                        @if(isset($category->children[0]))
                                        <div class="submenu mega-menu collapse" id="collapseExample-{{ $category->id }}"
                                            data-bs-parent="#menu-collapse">
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
                </div>
            </div>
        </div>
    </div>
</div>

@if (!Route::is('user.index'))
<div class="container">
    <div class="breadcrumb-container pt-3 pb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <x-link :href="route('user.index')">Trang chủ</x-link>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                @yield('title')
            </li>
        </ol>
    </div>
</div>
@endif

<button onclick="topFunction()" id="backToTopBtn" title="Go to top">
    <img src="{{ asset('public/user/assets/images/up-arrow.png') }}" alt="Back to Top" style="width: 48px; height: 48px;">
</button>

<script src="{{ asset('public/user/assets/js/back-to-top-btn.js') }}"></script>
