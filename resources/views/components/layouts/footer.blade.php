<x-floating-contact />
<div id="footer" class="bg-white">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-3 col-12 box ">
                <h6><strong>Liên hệ</strong></h6>
                <p><i class="fa-solid fa-clock text-red"></i> Bán hàng: <a style="color: red;" class="d-inline-block">08h00 - 17h30</a></p>
                <p><i class="fa fa-phone text-red"></i> Bán hàng: <a style="color: red;">0359.777.777 (nhánh số 1)</a></p>
                <p><i class="fa fa-phone text-red"></i> Office: <a style="color: red;">0359.777.777 (nhánh số 2)</a></p>
                <p><i class="fa fa-phone text-red"></i> Bảo hành: <a style="color: red;">0359.777.777 (nhánh số 3)</a></p>
                <p>
                    <i class="fa fa-envelope text-red"></i> Hợp tác khiếu nại:
                    <a style="color: #777777;" href="mailto:info@thebaha.global" style="color: red;"> info@bahagroup.vn</a>
                    <br>
                </p>
                <p><i class="fa-solid fa-location-dot text-red"></i> 77 Bùi Tá Hán, An Phú, Thành phố Thủ Đức</p>
                <span style="color: #02734a;"><a style="color: #02734a;" href="tel:0359777777">(+84)
                        0359-777-777</a></span>
            </div>
            <div class="col-lg-3 col-12 box">
                <h6><strong>Thông tin ngân hàng</strong></h6>
                <ul>
                    <li>
                        <p>TECHCOMBANK: <a style="color: red;" class="d-inline-block">87.87.87.87.87 - CN Thủ Đức - CÔNG TY CP TẬP ĐOÀN BAHA</a></p>
                    </li>
                    <li>
                        <p>BIDV: <a style="color: red;" class="d-inline-block">8696.777.777 - CN BẮC SÀI GÒN - CÔNG TY CP TẬP ĐOÀN BAHA</a></p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-12 box">
                <h6><strong>Hỗ trợ</strong></h6>
                <ul>
                    <li><a style="color: #777777;" href="#">Help Center</a></li>
                    <li><a style="color: #777777;" href="#">How to Buy</a></li>
                    <li><a style="color: #777777;" href="#">Shipping & Delivery</a></li>
                    <li><a style="color: #777777;" href="#">Product Policy</a></li>
                    <li><a style="color: #777777;" href="#">How to Return</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-12 box">
                <h6><strong>Mạng xã hội</strong></h6>
                <ul>
                    <li><a target="none" href="https://www.facebook.com/people/BaHa-Group/61559205100698/"><img width="64" height="64"
                                src="{{ asset('public/user/assets/images/facebook.png') }}"
                                class="attachment-full size-full wp-image-6789" alt=""> Facebook</a></li>
                    <li><a target="none" href="https://www.linkedin.com/company/baha-group-joint-stock-company/?viewAsMember=true"><img width="64" height="64"
                                src="{{ asset('public/user/assets/images/linkedin.png') }}"
                                class="attachment-full size-full wp-image-6790" alt=""> Linkedin</a></li>
                    <li><a target="none" href="https://www.tiktok.com/@baha_group_official"><img width="64" height="64"
                                src="{{ asset('public/user/assets/images/tiktok.png') }}"
                                class="attachment-full size-full wp-image-6791" alt=""> Tiktok</a></li>
                </ul>
            </div>
        </div>
        <div class="row d-flex mt-2 custom-line">
            @foreach ($parentCategories as $parentCategory)
                <div class="col-lg-3 col-12 box">
                    <p><strong>{{ $parentCategory->name }}</strong></p>
                    <p class="text-footer-category small mt-2 text-justify">
                        @foreach ($parentCategory->children as $children)
                            <x-link class="text-footer-category" :href="route('user.product.indexUser', ['category_id' => $children->id])">{{ $children->name }}</x-link>
                            @if (!$loop->last) | @endif
                            @foreach ($children->children as $item)
                                <x-link class="text-footer-category" :href="route('user.product.indexUser', ['category_id' => $item->id])">{{ $item->name }}</x-link>
                                @if (!$loop->last) | @endif
                            @endforeach
                        @endforeach
                    </p>
                </div>
            @endforeach
        </div>
        <div class="col-12 mb-5 mt-3 custom-line">
            <p><strong>Baha</strong> tự hào mang đến cho bạn một trải nghiệm mua sắm công nghệ tuyệt vời. Chúng tôi là
                địa điểm tốt nhất để bạn khám phá và tìm hiểu về những xu hướng công nghệ mới nhất, cũng như tìm mua các
                sản phẩm công nghệ hàng đầu.</p>
            <div style="color: #74818E" class="col-12 text-center">
            © Copyright <strong style="color: #444444">Mevivu</strong> All Rights Reserved<br>
                Designed by <a style="color: #5FB3E4" href="https://thietkeweb.mevivu.com/">Mevivu</a>
            </div>
        </div>
    </div>
</div>