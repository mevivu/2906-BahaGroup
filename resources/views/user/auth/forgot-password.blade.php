@extends('user.layouts.master')

@section('content')
    <div class="row container">
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quên mật khẩu</li>
            </ol>
        </div>
    </div>
    <div class="container mt-5">
        <div class="form-container">
        <h4 class="text-center">Lấy lại mật khẩu</h4>
            <form class="mt-3 align-items-center">
                <div class="mb-3">
                    <input type="email" class="form-control" id="loginEmail" placeholder="Email" required>
                </div>
                <div class="text-center mb-3">
                    <button style="width: 100%;" type="submit" class="btn btn-default">Lấy mã xác nhận</button>
                </div>
            </form>
        </div>
    </div>
@endsection



