@extends('user.layouts.master')

@section('content')
    <div class="row container">
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
            </ol>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row mt-3 mb-3">
                <div class="col-md-2">
                    <ul class="list-group">
                        <li onclick="location.href='my-order.php';" class="list-group-item list-item-my-account bg-default text-white"><i class="fa fa-shopping-cart ms-2 me-2"></i>ĐƠN HÀNG</li>
                        <li onclick="location.href='my-account.php';" class="list-group-item list-item-my-account"><i class="fa fa-user ms-2 me-2"></i>TÀI KHOẢN</li>
                        <li onclick="location.href='change-password.php';" class="list-group-item list-item-my-account"><i class="fa fa-sign-out ms-2 me-2"></i>MẬT KHẨU</li>
                        <li onclick="location.href='index.php';" class="list-group-item list-item-my-account"><i class="fa fa-sign-out ms-2 me-2"></i>ĐĂNG XUẤT</li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4 col-12 border-right">
                            <h3>Chi tiết đơn hàng</h3>
                            <p><strong>Mã đơn hàng:</strong> ORD123456</p>
                            <p><strong>Ngày đặt:</strong> 15/08/2024</p>
                            <p><strong>Phương thức thanh toán:</strong> Thanh toán khi nhận hàng</p>
                            <p><strong>Địa chỉ giao:</strong> 123 Đường ABC, Quận 1, TP. Hồ Chí Minh</p>
                            <p><strong>Tổng hoá đơn:</strong> 3,000,000₫</p>
                            <p><strong>Trạng thái:</strong> Đang xử lý</p>
                            <p><strong>Ghi chú:</strong> Giao hàng trong giờ hành chính</p>
                        </div>

                        <!-- Thông tin người dùng -->
                        <div class="col-md-4 col-12 border-right mt-4 mt-md-0">
                            <h4>Thông tin người dùng</h4>
                            <p><strong>Tên:</strong> Nguyễn Văn A</p>
                            <p><strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP. Hồ Chí Minh</p>
                            <p><strong>Số điện thoại:</strong> 0123456789</p>
                        </div>

                        <!-- Thông tin khác -->
                        <div class="col-md-4 col-12 mt-4 mt-md-0">
                            <h4>Thông tin khác</h4>
                            <p><strong>Tên người nhận:</strong> Trần Thị B</p>
                            <p><strong>Địa chỉ người nhận:</strong> 456 Đường XYZ, Quận 2, TP. Hồ Chí Minh</p>
                            <p><strong>Số điện thoại người nhận:</strong> 0987654321</p>
                            <p><strong>Ghi chú khác:</strong> Giao hàng sau 6 giờ tối</p>
                        </div>
                    </div>


                    <!-- Danh sách sản phẩm -->
                    <div class="mt-4">
                        <h4>Danh sách sản phẩm</h4>
                        <table class="table table-center justify-content-center text-center">
                            <thead>
                                <tr>
                                    <th class="text-start">Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bold-text">
                                    <td data-label="Sản phẩm">
                                        <div onclick="location.href='product-detail.php';" style="cursor: pointer" class="align-items-center product-info row">
                                            <div class="col-md-4 col-12"><img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" class="img-fluid card-item-img"></div>
                                            <div class="col-md-8 col-12">
                                                <div class="product-name">Tên sản phẩm 1</div>
                                                <div class="product-color">Xanh, 128GB</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle" data-label="Giá">1,000,000₫</td>
                                    <td class="align-middle" data-label="Số lượng">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <button class="btn btn-default" type="button" onclick="decrement()">-</button>
                                            <input class="form-control text-center mx-2" value="1" min="1" style="width: 60px;">
                                            <button class="btn btn-default" type="button" onclick="increment()">+</button>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center" data-label="Tổng">1,000,000₫</td>
                                </tr>
                                <tr class="bold-text">
                                    <td data-label="Sản phẩm">
                                        <div onclick="location.href='product-detail.php';" style="cursor: pointer" class="align-items-center product-info row">
                                            <div class="col-md-4 col-12"><img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" class="img-fluid card-item-img"></div>
                                            <div class="col-md-8 col-12">
                                                <div class="product-name">Tên sản phẩm 1</div>
                                                <div class="product-color">Xanh, 128GB</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle" data-label="Giá">1,000,000₫</td>
                                    <td class="align-middle" data-label="Số lượng">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <button class="btn btn-default" type="button" onclick="decrement()">-</button>
                                            <input class="form-control text-center mx-2" value="1" min="1" style="width: 60px;">
                                            <button class="btn btn-default" type="button" onclick="increment()">+</button>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center" data-label="Tổng">1,000,000₫</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




