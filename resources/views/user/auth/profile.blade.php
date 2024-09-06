@extends('user.layouts.master')

@section('content')
    <div class="row container">
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
            </ol>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row mb-3 mt-3">
            <div class="col-md-2">
                <ul class="list-group">
                    <li onclick="location.href='my-order.php';" class="list-group-item list-item-my-account"><i class="fa fa-shopping-cart ms-2 me-2"></i>ĐƠN HÀNG</li>
                    <li onclick="location.href='my-account.php';" class="list-group-item list-item-my-account bg-default text-white"><i class="fa fa-user ms-2 me-2"></i>TÀI KHOẢN</li>
                    <li onclick="location.href='change-password.php';" class="list-group-item list-item-my-account"><i class="fa fa-sign-out ms-2 me-2"></i>MẬT KHẨU</li>
                    <li onclick="location.href='index.php';" class="list-group-item list-item-my-account"><i class="fa fa-sign-out ms-2 me-2"></i>ĐĂNG XUẤT</li>
                </ul>
            </div>
            <div class="col-md-10">
                <form>
                    <div class="row">
                        <!-- Họ và tên -->
                        <div class="col-md-6">
                            <label for="fullName">Họ và tên <p style="display: inline;" class="text-red">*</p></label>
                            <input type="text" class="form-control" id="fullName" placeholder="Nhập họ và tên">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email">Email <p style="display: inline;" class="text-red">*</p></label>
                            <input type="email" class="form-control" id="email" placeholder="Nhập email">
                        </div>

                        <!-- Số điện thoại -->
                        <div class="col-md-6 mt-3">
                            <label for="phone">Số điện thoại <p style="display: inline;" class="text-red">*</p></label>
                            <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại">
                        </div>

                        <!-- Ngày sinh -->
                        <div class="col-md-6 mt-3">
                            <label for="dob">Ngày sinh <p style="display: inline;" class="text-red">*</p></label>
                            <input type="date" class="form-control" id="dob">
                        </div>

                        <!-- Giới tính -->
                        <div class="col-md-3 mt-3">
                            <label for="gender">Giới tính <p style="display: inline;" class="text-red">*</p></label>
                            <select class="form-control" id="gender">
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>

                        <!-- Địa chỉ -->
                        <div class="col-md-9 mt-3">
                            <label for="address">Địa chỉ <p style="display: inline;" class="text-red">*</p></label>
                            <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ">
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><button type="submit" class="btn btn-default w-100 mt-2"><strong>CẬP NHẬT</strong></button></div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection



