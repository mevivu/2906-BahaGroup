@extends('user.layouts.master')
@section('title', __('Giới thiệu'))

@section('content')
    <div style="width: 100%; position: relative;">
        <div class="banner-information" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%,rgba(0,0,0,0.4) 100%), url('{{ asset('public/user/assets/images/bg-about-us.jpg') }}');">
            <div class="banner-content text-white">
                <div class="col-md-6">
                    <h1>
                        Bộ sưu tập <strong>phụ kiện điện tử và các sản phẩm công nghệ khác</strong>
                    </h1>
                    <p>Chất lượng là ưu tiên hàng đầu của chúng tôi, vì vậy bạn có thể yên tâm rằng bạn đang mua sắm những sản phẩm chính hãng và đáng tin cậy.</p>
                    <a href="{{ route('user.contact') }}" class="btn btn-default"><strong>Liên hệ ngay</strong></a>
                </div>
            </div>
            <div style="width: 80%;" class="row mb-5 flex-section margin-information justify-content-between">
                <div class="col-4 col-md-12 col-12 bg-white mb-3 shadow">
                    <div style="margin-top: 2rem;"></div>
                    <i class="fa fa-cart-plus info-icon ms-3 me-3"></i>
                    <h4 class="ms-3 me-3 mt-3">Đa dạng sản phẩm</h4>
                    <p class="ms-3 me-3">
                        Từ điện thoại thông minh, máy tính xách tay, phụ kiện điện tử đến thiết bị gia đình thông minh, chúng tôi đã tạo ra một bộ sưu tập đáng kinh ngạc để đáp ứng mọi nhu cầu của khách hàng.
                    </p>
                    <a class="btn btn-default mb-4 ms-3 me-3">Xem thêm</a>
                </div>
                <div class="col-4 col-md-12 col-12 bg-white mb-3 shadow">
                    <div style="margin-top: 2rem;"></div>
                    <i class="fa fa-credit-card info-icon ms-3 me-3"></i>
                    <h4 class="ms-3 me-3 mt-3">Mua sắm trực tuyến</h4>
                    <p class="ms-3 me-3">
                        Từ điện thoại thông minh, máy tính xách tay, phụ kiện điện tử đến thiết bị gia đình thông minh, chúng tôi đã tạo ra một bộ sưu tập đáng kinh ngạc để đáp ứng mọi nhu cầu của khách hàng.
                    </p>
                    <a class="btn btn-default mb-4 ms-3 me-3">Xem thêm</a>
                </div>
                <div class="col-4 col-md-12 col-12 bg-white mb-3 shadow">
                    <div style="margin-top: 2rem;"></div>
                    <i class="fa fa-check-circle info-icon ms-3 me-3"></i>
                    <h4 class="ms-3 me-3 mt-3">Cam kết chất lượng</h4>
                    <p class="ms-3 me-3">
                        Từ điện thoại thông minh, máy tính xách tay, phụ kiện điện tử đến thiết bị gia đình thông minh, chúng tôi đã tạo ra một bộ sưu tập đáng kinh ngạc để đáp ứng mọi nhu cầu của khách hàng.
                    </p>
                    <a class="btn btn-default mb-4 ms-3 me-3">Xem thêm</a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white section-gap-default responsive-section" style="width: 100%">
        <div class="margin-information p-5 rounded">
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <h2><strong>TẦM NHÌN</strong></h2>
                    <p class="lead text-secondary">
                        Bằng khát vọng tiên phong cùng chiến lược đầu tư - phát triển bền vững, BaHa đặt mục tiêu trở thành Tập đoàn truyền thông thương mại - marketing hàng đầu tại Việt Nam và vươn tầm khu vực Đông Nam Á. Trở thành đối tác tin cậy, chiến lược, mang đến cho khách hàng trải nghiệm tối ưu và mức độ hài lòng cao nhất.
                    </p>
                </div>
            </div>
            <div class="row d-flex flex-wrap justify-content-center">
                <div class="col-md-3 col-12 p-3 text-center" style="border-radius: 5px">
                    <i class="fa fa-trophy fa-3x mb-3" style="color: #7AC14A; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <p class="text-justify">Nắm giữ vị trí dẫn đầu trong lĩnh vực cung cấp các sản phẩm và dịch vụ chất lượng cao.</p>
                </div>
                <div class="col-md-3 col-12 p-3 text-center" style="border-radius: 5px">
                    <i class="fa fa-users fa-3x mb-3" style="color: #7AC14A; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <p class="text-justify">Đào tạo và xây dựng đội ngũ nhân viên năng động, có trình độ chuyên môn giỏi, tâm huyết với công việc.</p>
                </div>
                <div class="col-md-3 col-12 p-3 text-center" style="border-radius: 5px">
                    <i class="fa fa-building fa-3x mb-3" style="color: #7AC14A; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <p class="text-justify">Xây dựng công ty với hệ thống quản trị khoa học, minh bạch, phát triển để trở thành một doanh nghiệp kinh doanh vững mạnh, an toàn.</p>
                </div>
                <div class="col-md-3 col-12 p-3 text-center" style="border-radius: 5px">
                    <i class="fa fa-check-circle fa-3x mb-3" style="color: #7AC14A; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <p class="text-justify">Đảm bảo mọi sản phẩm - dịch vụ đều đạt chất lượng và hiệu quả cao nhất.</p>
                </div>
            </div>
        </div>
    </div>

    <div style="background-image: url('{{ asset('public/user/assets/images/nen1.png') }}'); width: 100%" class="responsive-section bg-white text-white">
        <div class="margin-information p-5 rounded">
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <h2><strong>SỨ MỆNH</strong></h2>
                    <p><i><u>“Đội ngũ tiên phong - Nâng tầm giá trị”</u></i></p>
                    <p class="lead">
                        "Sứ mệnh của chúng tôi là tạo ra một đội ngũ tiên phong, không ngừng đổi mới và nâng cao giá trị, đem lại sự khác biệt cho khách hàng và cộng đồng,mang lại những trải nghiệm và thành công vượt bậc."
                    </p>
                </div>
            </div>

            <div class="row d-flex flex-wrap justify-content-center">
                <div class="col-md-4 col-12 text-center p-3" style="border-radius: 5px">
                    <i class="fa fa-line-chart fa-3x mb-3" style="border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <p class="text-justify">BaHa đề cao tinh thần cầu tiến, mỗi thành viên trong tập thể cam kết cải tiến 1% mỗi ngày. Chúng tôi không ngừng nâng cao chất lượng dịch vụ, hoàn thiện từng khâu nhỏ để mang đến trải nghiệm hoàn hảo cho khách hàng.</p>
                </div>
                <div class="col-md-4 col-12 text-center p-3" style="border-radius: 5px">
                    <i class="fa-solid fa-hands-holding-child fa-3x mb-3" style="border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <p class="text-justify">BaHa hướng đến xây dựng một môi trường làm việc văn minh, đề cao giá trị đạo đức và văn hóa doanh nghiệp. Mỗi hành trình mua sắm tại BaHa đều mang đến cho khách hàng trải nghiệm TỐT, sự hài lòng và ấn tượng sâu sắc.</p>
                </div>
                <div class="col-md-4 col-12 text-center p-3" style="border-radius: 5px">
                    <i class="fa fa-star fa-3x mb-3" style="border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <p class="text-justify">Mong muốn tạo ra sự khác biệt so với các đối thủ cạnh tranh, trở thành thương hiệu được khách hàng tin tưởng và yêu thích.</p>
                </div>
            </div>
        </div>
    </div>

    <div style="background-image: url('{{ asset('public/user/assets/images/nen2.png') }}'); width: 100%" class="responsive-section bg-white">
        <div class="margin-information p-5 rounded">
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <h2><strong>GIÁ TRỊ CỐT LÕI</strong></h2>
                    <p class="lead text-start">
                        Baha Group xác định <strong>Tâm - Trí - Nhân - Tín - Tiến - Chất</strong> là kim chỉ nam cho mọi hoạt động, là nền tảng đạo đức và trí tuệ vững chắc cho sự phát triển bền vững.
                    </p>
                    <p class="lead text-start">Giá trị cốt lõi của Baha Group:</p>
                </div>
            </div>

            <div class="row d-flex flex-wrap justify-content-center">
                <div class="col-md-2 col-12 text-center p-3" style="border-radius: 5px">
                    <i class="fa fa-heart fa-3x mb-3" style="color: #7FC84E; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <div class="highlight-container">
                        <span class="highlight">TÂM</span>
                    </div>
                    <p class="text-justify">Cống hiến hết mình, tận tâm với công việc để đạt được mục tiêu và mang lại giá trị đích thực cho khách hàng và đối tác. Hành động với tinh thần nhân văn, đề cao sự tôn trọng và hỗ trợ lẫn nhau.</p>
                </div>
                <div class="col-md-2 col-12 text-center p-3" style="border-radius: 5px">
                    <i class="fa fa-user-circle fa-3x mb-3" style="color: #7FC84E; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <div class="highlight-container">
                        <span class="highlight">TRÍ</span>
                    </div>
                    <p class="text-justify">Sử dụng trí tuệ và sự sáng tạo để giải quyết các vấn đề và đưa ra các giải pháp tối ưu.</p>
                </div>
                <div class="col-md-2 col-12 text-center p-3" style="border-radius: 5px">
                    <i class="fa fa-users fa-3x mb-3" style="color: #7FC84E; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <div class="highlight-container">
                        <span class="highlight">NHÂN</span>
                    </div>
                    <p class="text-justify">Đề cao giá trị con người, xây dựng đội ngũ nhân viên năng động, có trình độ chuyên môn giỏi, tâm huyết với công việc.</p>
                </div>
                <div class="col-md-2 col-12 text-center p-3" style="border-radius: 5px">
                    <i class="fa-solid fa-handshake-angle fa-3x mb-3" style="color: #7FC84E; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <div class="highlight-container">
                        <span class="highlight">TÍN</span>
                    </div>
                    <p class="text-justify">Giữ chữ tín với khách hàng và đối tác, luôn hành động đúng cam kết.</p>
                </div>
                <div class="col-md-2 col-12 text-center p-3" style="border-radius: 5px">
                    <i class="fa fa-arrow-up fa-3x mb-3" style="color: #7FC84E; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <div class="highlight-container">
                        <span class="highlight">TIẾN</span>
                    </div>
                    <p class="text-justify">Luôn tiến lên, không ngừng cải tiến và phát triển để đạt được những thành tựu mới.</p>
                </div>
                <div class="col-md-2 col-12 text-center p-3" style="border-radius: 5px">
                    <i class="fa fa-check-circle fa-3x mb-3" style="color: #7FC84E; border: 2px solid #cccccc; border-radius: 50%; padding: 0.8em; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></i>
                    <div class="highlight-container">
                        <span class="highlight">CHẤT</span>
                    </div>
                    <p class="text-justify">Đảm bảo chất lượng trong mọi sản phẩm và dịch vụ, mang lại sự hài lòng cao nhất cho khách hàng.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5" style="width: 100%;">
        <h2><strong>THÀNH TỰU TUYỆT VỜI</strong></h2>
        <p class="lead">
            Khám phá <strong>tận hưởng tiện lợi và sự đa dạng</strong> của mua sắm trực tuyến
        </p>
    </div>
    <div class="text-center section-percent margin-information">
        <div class="row mt-5">
            <div class="col-md-4">
                <h2><strong>1,000+</strong></h2>
                <p>
                    Thương hiệu nổi tiếng
                </p>
            </div>
            <div style="border-left: 1px solid; border-right: 1px solid" class="col-md-4">
                <h2><strong>95%</strong></h2>
                <p>
                    Khách hàng hoàn toàn hài lòng
                </p>
            </div>
            <div class="col-md-4">
                <h2><strong>99+</strong></h2>
                <p>
                    Danh mục sản phẩm nổi bật
                </p>
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-md-4">
                <h2><strong>131,000+</strong></h2>
                <p>
                    Đơn hàng đã được đặt
                </p>
            </div>
            <div style="border-left: 1px solid; border-right: 1px solid" class="col-md-4">
                <h2><strong>200,000+</strong></h2>
                <p>
                    Sản phẩm công nghệ hàng đầu
                </p>
            </div>
            <div class="col-md-4">
                <h2><strong>39%</strong></h2>
                <p>
                    Lợi nhuận hàng năm tăng trưởng
                </p>
            </div>
        </div>
    </div>
@endsection



