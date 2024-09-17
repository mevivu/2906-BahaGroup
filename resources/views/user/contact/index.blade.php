@extends('user.layouts.master')
@section('title', __('Liên hệ'))

@section('content')
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <div class="contact-info mt-4">
                        <h3>Thông tin liên hệ</h3>
                        <p><i class="fa fa-clock-o text-red"></i> Bán hàng: <a style="color: red;" class="d-inline-block">08h00 - 17h30</a></p>
                        <p><i class="fa fa-phone text-red"></i> Bán hàng: <a style="color: red;">0359.777.777 (nhánh số 1)</a></p>
                        <p><i class="fa fa-phone text-red"></i> Office: <a style="color: red;">0359.777.777 (nhánh số 2)</a></p>
                        <p><i class="fa fa-phone text-red"></i> Bảo hành: <a style="color: red;">0359.777.777 (nhánh số 3)</a></p>
                        <p>
                            <i class="fa fa-envelope text-red"></i> Hợp tác khiếu nại:
                            <a href="mailto:info@thebaha.global" style="color: red;"> info@bahagroup.vn</a>
                            <br>
                        </p>
                        <p><i class="fa fa-map-marker text-red"></i> 77 Bùi Tá Hán, An Phú, Thành phố Thủ Đức</p>
                        <span style="color: #02734a;"><a style="color: #02734a;" href="tel:0359777777">(+84)
                                0359-777-777</a></span>
                    </div>
                    <div class="social-media mt-3">
                        <h6>Mạng xã hội</h6>
                        <ul>
                            <li><a target="none" href="https://www.facebook.com/people/BaHa-Group/61559205100698/"><img width="64" height="64"
                                src="{{ asset('public/user/assets/images/facebook.png') }}"
                                class="attachment-full size-full wp-image-6789" alt=""></a></li>
                            <li><a target="none" href="https://www.linkedin.com/company/baha-group-joint-stock-company/?viewAsMember=true"><img width="64" height="64"
                                src="{{ asset('public/user/assets/images/linkedin.png') }}"
                                class="attachment-full size-full wp-image-6790" alt=""></a></li>
                            <li><a target="none" href="https://www.tiktok.com/@baha_group_official"><img width="64" height="64"
                                src="{{ asset('public/user/assets/images/tiktok.png') }}"
                                class="attachment-full size-full wp-image-6791" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="map me-3 mt-4">
                        <div style="width: 100%"><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q=77%20B%C3%B9i%20T%C3%A1%20H%C3%A1n,%20An%20Ph%C3%BA,%20Th%C3%A0nh%20ph%E1%BB%91%20Th%E1%BB%A7%20%C4%90%E1%BB%A9c+(BahaGroup)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/">gps tracker sport</a></iframe></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


