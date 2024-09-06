@extends('user.layouts.master')

@section('content')
    <div class="row container">
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
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
                        <table class="table table-center styled-table justify-content-center text-center no-border">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bold-text">
                                    <td data-label="Mã đơn hàng" class="align-middle"><a class="ms-2 text-default" href="order-detail.php">ORD123456</a></td>
                                    <td class="align-middle" data-label="Ngày đặt">15/08/2024</td>
                                    <td class="align-middle" data-label="Tổng tiền">1,000,000₫</td>
                                    <td class="align-middle" data-label="Trạng thái">Đang xử lý</td>
                                    <td style="font-size: 1.5em;" class="align-middle"><i class="fa fa-trash text-danger" data-label="Hành động"></i></td>
                                </tr>
                                <tr class="bold-text">
                                    <td class="align-middle"><a class="ms-2 text-default" href="order-detail.php" data-label="Mã đơn hàng">ORD123456</a></td>
                                    <td class="align-middle" data-label="Ngày đặt">16/08/2024</td>
                                    <td class="align-middle" data-label="Tổng tiền">2,000,000₫</td>
                                    <td class="align-middle" data-label="Trạng thái">Đã hoàn thành</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




