<!-- Main Header -->
<div id="main-container" class="d-none d-xl-block bg-white pt-3">
    <div class="d-flex align-items-center justify-content-center wrap-nav mb-3">
        <div class="container row justify-content-center align-items-center">
            <div class="row">
                <div style="margin-left: -2.5em;" class="col-6 d-flex align-items-center mb-3">
                    <p class="m-0">Miễn phí vận chuyển trong <span style="color: #02734a;"><strong>Ngày của
                                Baha.</strong></span></p>
                </div>
                <div class="col-6 text-center d-flex align-items-center justify-content-center mb-3">
                </div>
                <!-- Logo -->
                <div style="margin-left: -2.5em;" class="col-3 d-flex align-items-center">
                    <a href="{{ route('user.index') }}"><img style="image-rendering: pixelated;"
                            src="{{ asset('public/user/assets/images/logo-ngang.png') }}"
                            alt="Baha" height="60" width="250"></a>
                </div>
                <!-- Search Bar -->
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <div class="input-group">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Tất cả</button>
                        <ul class="dropdown-menu search">
                            <li class="dropdown-item selected"><label>Tất cả</label></li>
                            <li class="dropdown-item"><label>Babies & Toys&nbsp;&nbsp;(6)</label></li>
                            <li class="dropdown-item"><label>Books & Audible&nbsp;&nbsp;(4)</label></li>
                            <li class="dropdown-item"><label>Fashion & Clothing&nbsp;&nbsp;(16)</label></li>
                            <li class="dropdown-item"><label>Games & Toys&nbsp;&nbsp;(1)</label></li>
                            <li class="dropdown-item"><label>Garden&nbsp;&nbsp;(5)</label></li>
                            <li class="dropdown-item"><label>Health & Beauty&nbsp;&nbsp;(12)</label></li>
                            <li class="dropdown-item"><label>Home & Kitchen&nbsp;&nbsp;(9)</label></li>
                            <li class="dropdown-item"><label>Home Audio&nbsp;&nbsp;(4)</label></li>
                            <li class="dropdown-item"><label>Phụ kiện điện tử&nbsp;&nbsp;(15)</label></li>
                            <li class="dropdown-item"><label>Sports & Travel&nbsp;&nbsp;(14)</label></li>
                            <li class="dropdown-item"><label>Thiết bị điện tử&nbsp;&nbsp;(19)</label></li>
                            <li class="dropdown-item"><label>TV & Home Appliances&nbsp;&nbsp;(10)</label></li>
                        </ul>
                        <input type="text" class="form-control" placeholder="Nhập từ khóa bạn muốn tìm kiếm..." aria-label="Text input with dropdown button">
                        <button type="submit" class="button-search btn"><i class="ti ti-search"></i></button>
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
                                <a class="dropdown-item" href="{{ route('user.profile.indexUser') }}">Tài khoản</a>
                                <a class="dropdown-item" href="{{ route('user.logout') }}">Đăng xuất</a>
                            </div>
                        </div>
                    @endif
                    <div class="position-relative">
                        <i onclick="location.href='{{ route('user.cart.index' )}}';" style="font-size: 2em;cursor: pointer;" class="ti ti-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="left: 100% !important;">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<div id="navbar" class="row mt-2">
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
                    <li class="nav-item default-font-size"><strong><a href="{{ route('user.index') }}">Trang chủ</a></strong></li>
                    <li class="nav-item default-font-size"><strong><a href="{{ route('user.information') }}">Giới thiệu</a></strong></li>
                    <li class="nav-item default-font-size"><strong><a href="{{ route('user.product.indexUser') }}">Sản phẩm</a></strong></li>
                    <li class="nav-item default-font-size"><strong><a href="{{ route('user.contact') }}">Liên hệ</a></strong></li>
                    <li class="nav-item default-font-size"><strong><a href="{{ route('user.product.saleLimited') }}">Khuyến mãi giới hạn</a></strong></li>
                </ul>
            </div>
            <!-- NavBar Responsive-->
            <div class="nav-responsive row container d-xl-none d-flex">
                <button class="col-3 btn d-xl-none d-block" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="ti ti-list default-double-font-size"></i>
                </button>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <a href="#"><img
                            src="{{ asset('public/user/assets/images/logo-ngang.png') }}"
                            alt="Baha" height="42" width="174"></a>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center cart">
                    <div class="position-relative">
                        <i onclick="location.href='{{ route('user.cart.index' )}}';" style="font-size: 2em;cursor: pointer;" class="ti ti-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="left: 100% !important;">0</span>
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
                                type="button" role="tab" aria-controls="menu" aria-selected="true"><i
                                    class="ti ti-list"></i> Menu</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="category-tab" data-bs-toggle="tab" data-bs-target="#category"
                                type="button" role="tab" aria-controls="category" aria-selected="false"><i
                                    class="ti ti-list"></i> Danh mục</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- Menu Tab -->
                        <div class="tab-pane fade show active" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                            <ul class="nav">
                                <li class="nav-item default-font-size"><strong><a href="{{ route('user.index') }}">Trang chủ</a></strong></li>
                                <li class="nav-item default-font-size"><strong><a href="{{ route('user.information') }}">Giới thiệu</a></strong></li>
                                <li class="nav-item default-font-size"><strong><a href="{{ route('user.product.indexUser') }}">Sản phẩm</a></strong></li>
                                <li class="nav-item default-font-size"><strong><a href="{{ route('user.contact') }}">Liên hệ</a></strong></li>
                                <li class="nav-item default-font-size"><strong><a href="{{ route('user.product.saleLimited') }}">Khuyến mãi giới hạn</a></strong></li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
                            <ul class="menu">
                                <li>
                                    <a href="#"><i class="ti ti-device-mobile"></i>Thiết bị điện tử <i
                                            class="ti ti-chevron-right" data-bs-toggle="collapse"
                                            href="#collapseExample-1" role="button" aria-expanded="false"
                                            aria-controls="collapseExample-1"></i></a>
                                    <div class="submenu mega-menu collapse" id="collapseExample-1"
                                        data-bs-parent="#menu-collapse">
                                        <div class="mega-column">
                                            <h3>Phụ kiện di động</h3>
                                            <ul>
                                                <li><a href="#">Laptops</a></li>
                                                <li><a href="#">Desktops</a></li>
                                                <li><a href="#">Mobile</a></li>
                                                <li><a href="#">Computers</a></li>
                                                <li><a href="#">Speakers</a></li>
                                                <li><a href="#">Headphones</a></li>
                                                <li><a href="#">Smartwatch</a></li>
                                                <li><a href="#">Drives & Storage</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><i class="ti ti-headphones"></i>Accessories <i
                                            class="ti ti-chevron-right" data-bs-toggle="collapse"
                                            href="#collapseExample-2" role="button" aria-expanded="false"
                                            aria-controls="collapseExample-2"></i></a>
                                    <div class="submenu mega-menu collapse" id="collapseExample-2"
                                        data-bs-parent="#menu-collapse">
                                        <div class="mega-column">
                                            <h3>Phụ kiện di động</h3>
                                            <ul>
                                                <li><a href="#">Power Banks</a></li>
                                                <li><a href="#">Cables & Converters</a></li>
                                                <li><a href="#">Wall Chargers</a></li>
                                                <li><a href="#">Wireless Chargers</a></li>
                                                <li><a href="#">Phone Cases & Covers</a></li>
                                                <li><a href="#">Tablet Cases & Covers</a></li>
                                                <li><a href="#">Screen Protectors</a></li>
                                                <li><a href="#">Selfie Sticks</a></li>
                                                <li><a href="#">Car Chargers</a></li>
                                                <li><a href="#">Prepaid Cards</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-column">
                                            <h3>Phụ kiện máy móc</h3>
                                            <ul>
                                                <li><a href="#">Mac Accessories</a></li>
                                                <li><a href="#">Keyboards</a></li>
                                                <li><a href="#">Mice</a></li>
                                                <li><a href="#">Webcams</a></li>
                                                <li><a href="#">Cooling Pads/Cooling Stands</a></li>
                                                <li><a href="#">External DVD Writers</a></li>
                                                <li><a href="#">Laptop Batteries</a></li>
                                                <li><a href="#">Software</a></li>
                                                <li><a href="#">Mousepads</a></li>
                                                <li><a href="#">Skins & Decals</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-column">
                                            <h3>Công cụ</h3>
                                            <ul>
                                                <li><a href="#">Laser Pointers</a></li>
                                                <li><a href="#">Metal Detectors</a></li>
                                                <li><a href="#">Dictionaries & Translators</a></li>
                                                <li><a href="#">Universal Chargers</a></li>
                                                <li><a href="#">Graphic Tablets</a></li>
                                                <li><a href="#">Walkie-Talkies</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-column">
                                            <h3>Phụ kiện mạng</h3>
                                            <ul>
                                                <li><a href="#">Routers</a></li>
                                                <li><a href="#">Network Access Points</a></li>
                                                <li><a href="#">Switches</a></li>
                                                <li><a href="#">Network Interface Cards</a></li>
                                                <li><a href="#">Wireless USB Adapters</a></li>
                                                <li><a href="#">Modems</a></li>
                                                <li><a href="#">Range Extender</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Other Category Items -->
                                <li><a href="#"><i class="ti ti-screen-share"></i> TV & Home Appliances</a></li>
                                <li><a href="#"><i class="ti ti-clipboard-heart"></i>Health & Beauty</a></li>
                                <li><a href="#"><i class="ti ti-baby-carriage"></i>Babies & Toys</a></li>
                                <li><a href="#"><i class="ti ti-jacket"></i>Fashion & Clothing</a></li>
                                <li>
                                    <a href="#"><i class="ti ti-tools-kitchen"></i>Home & Kitchen <i
                                            class="ti ti-chevron-right" data-bs-toggle="collapse"
                                            href="#collapseExample-3" role="button" aria-expanded="false"
                                            aria-controls="collapseExample-3"></i></a>
                                    <div class="submenu mega-menu collapse" id="collapseExample-3"
                                        data-bs-parent="#menu-collapse">
                                        <div class="mega-column">
                                            <h3>Phụ kiện di động</h3>
                                            <ul>
                                                <li><a href="#">Power Banks</a></li>
                                                <li><a href="#">Cables & Converters</a></li>
                                                <li><a href="#">Wall Chargers</a></li>
                                                <li><a href="#">Wireless Chargers</a></li>
                                                <li><a href="#">Phone Cases & Covers</a></li>
                                                <li><a href="#">Tablet Cases & Covers</a></li>
                                                <li><a href="#">Screen Protectors</a></li>
                                                <li><a href="#">Selfie Sticks</a></li>
                                                <li><a href="#">Car Chargers</a></li>
                                                <li><a href="#">Prepaid Cards</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-column">
                                            <h3>Phụ kiện máy móc</h3>
                                            <ul>
                                                <li><a href="#">Mac Accessories</a></li>
                                                <li><a href="#">Keyboards</a></li>
                                                <li><a href="#">Mice</a></li>
                                                <li><a href="#">Webcams</a></li>
                                                <li><a href="#">Cooling Pads/Cooling Stands</a></li>
                                                <li><a href="#">External DVD Writers</a></li>
                                                <li><a href="#">Laptop Batteries</a></li>
                                                <li><a href="#">Software</a></li>
                                                <li><a href="#">Mousepads</a></li>
                                                <li><a href="#">Skins & Decals</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-column">
                                            <h3>Công cụ</h3>
                                            <ul>
                                                <li><a href="#">Laser Pointers</a></li>
                                                <li><a href="#">Metal Detectors</a></li>
                                                <li><a href="#">Dictionaries & Translators</a></li>
                                                <li><a href="#">Universal Chargers</a></li>
                                                <li><a href="#">Graphic Tablets</a></li>
                                                <li><a href="#">Walkie-Talkies</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-column">
                                            <h3>Phụ kiện mạng</h3>
                                            <ul>
                                                <li><a href="#">Routers</a></li>
                                                <li><a href="#">Network Access Points</a></li>
                                                <li><a href="#">Switches</a></li>
                                                <li><a href="#">Network Interface Cards</a></li>
                                                <li><a href="#">Wireless USB Adapters</a></li>
                                                <li><a href="#">Modems</a></li>
                                                <li><a href="#">Range Extender</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="ti ti-ball-football"></i>Sports & Travel</a></li>
                                <li><a href="#"><i class="ti ti-book"></i>Book & Audible</a></li>
                                <li><a href="#"><i class="ti ti-dog"></i>Pantry Food & Pet Supplies</a></li>
                                <li><a href="#"><i class="ti ti-trees"></i>Garden</a></li>
                                <li><a href="#"><i class="ti ti-radio"></i> Home Audio</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<button onclick="topFunction()" id="backToTopBtn" title="Go to top">
    <img src="{{ asset('public/user/assets/images/up-arrow.png') }}" alt="Back to Top" style="width: 48px; height: 48px;">
</button>

<script src="{{ asset('public/user/assets/js/back-to-top-btn.js') }}"></script>
