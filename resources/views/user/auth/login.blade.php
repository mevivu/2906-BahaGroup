@extends('user.layouts.master')

@section('content')
    <div class="row container">
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
            </ol>
        </div>
    </div>
    <div class="container mt-5">
        <div style="border: none; border-radius: 0" class="form-container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Đăng nhập</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Đăng ký</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <form class="mt-3 align-items-center">
                        <div class="mb-3">
                            <input type="email" class="form-control" id="loginEmail" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="loginPassword" placeholder="Mật khẩu" required>
                        </div>
                        <div class="text-center mb-3">
                            <button style="width: 100%;" type="submit" class="btn btn-default">Đăng nhập</button>
                        </div>
                        <div class="text-center">
                            <a href="forgot-password.php" style="width: 100%;" type="Quên mật khẩu" class="btn btn-outline-success">Quên mật khẩu</a>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                    <form class="mt-3">
                        <div class="mb-3">
                            <input type="email" class="form-control" id="registeemail" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="registerPassword" placeholder="Mật khẩu" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Xác nhận mật khẩu" required>
                        </div>
                        <button style="width: 100%;" type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection



