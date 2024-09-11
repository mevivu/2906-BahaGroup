@extends('user.layouts.master')

@section('content')
    <div class="row container">
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
            </ol>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row mb-3 mt-3">
                <div class="col-md-2">
                    <ul class="list-group">
                        <li onclick="location.href='my-order.php';" class="list-group-item list-item-my-account"><i class="fa fa-shopping-cart ms-2 me-2"></i>ĐƠN HÀNG</li>
                        <li onclick="location.href='my-account.php';" class="list-group-item list-item-my-account"><i class="fa fa-user ms-2 me-2"></i>TÀI KHOẢN</li>
                        <li onclick="location.href='change-password.php';" class="list-group-item list-item-my-account bg-default text-white"><i class="fa fa-sign-out ms-2 me-2"></i>MẬT KHẨU</li>
                        <li onclick="location.href='index.php';" class="list-group-item list-item-my-account"><i class="fa fa-sign-out ms-2 me-2"></i>ĐĂNG XUẤT</li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <form>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <label for="currentPassword">Mật khẩu hiện tại <p style="display: inline;" class="text-red">*</p></label>
                                <input type="password" class="form-control" id="currentPassword" placeholder="Nhập mật khẩu hiện tại">

                                <label class="mt-3" for="newPassword">Mật khẩu mới <p style="display: inline;" class="text-red">*</p></label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Nhập mật khẩu mới">

                                <label class="mt-3" for="confirmPassword">Xác nhận mật khẩu mới <p style="display: inline;" class="text-red">*</p></label>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Xác nhận mật khẩu mới">
                                <button type="submit" class="btn btn-default w-100 mt-2"><strong>CẬP NHẬT</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



