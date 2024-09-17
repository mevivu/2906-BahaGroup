@extends('user.layouts.master')

@section('title', __('Giỏ hàng'))

@section('content')
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row">
            <div class="col-md-8 mt-3 mb-3">
                <table class="table table-center justify-content-center text-center">
                    <thead>
                        <tr>
                            <th class="text-start">Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th class="delete-header"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bold-text">
                            <td data-label="Sản phẩm">
                                <div onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" style="cursor: pointer" class="align-items-center product-info row">
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
                            <td class="align-middle delete-cell" style="font-size: 1.5em;"><i class="fa fa-trash text-danger"></i></td>
                        </tr>
                        <tr class="bold-text">
                            <td data-label="Sản phẩm">
                                <div onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" style="cursor: pointer" class="align-items-center product-info row">
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
                            <td class="align-middle delete-cell" style="font-size: 1.5em;"><i class="fa fa-trash text-danger"></i></td>
                        </tr>
                    </tbody>
                </table>
                <div class="progress d-flex align-items-center">
                    <div style="font-size: 16px; color: #ffffff" class="progress-text">
                        <strong>95%</strong>
                    </div>
                    <div class="progress-bar" role="progressbar" style="width: 95%; background-color: #1C5639;">.</div>
                </div>
                <p class="text-center mt-3">Chi thêm <strong style="color: #1C5639">790,000₫</strong> để được <strong>MIỄN PHÍ VẬN CHUYỂN!</strong><br>
                    Thêm nhiều sản phẩm hơn vào giỏ hàng của bạn và nhận giao hàng miễn phí cho đơn hàng từ<br><strong style="color: #1C5639">3,000,000₫</strong></p>
            </div>

            <div class="col-md-4 mt-3 mb-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Áp dụng mã giảm giá</h5>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                            <button class="btn btn-default" type="button">Áp dụng</button>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title">Tạm tính</h6>
                            <p class="card-text text-default"><strong>1,000,000₫</strong></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title">Giao hàng</h6>
                            <p class="card-text"><strong>Giao hàng miễn phí</strong></p>
                        </div>
                        <div style="border-top: 1px solid #f5f5f5;" class="d-flex justify-content-between">
                            <h6 class="card-title mt-3">Tổng tiền</h6>
                            <p class="card-text text-default mt-3"><strong>1,000,000₫</strong></p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('user.payment.payment') }}" class="btn btn-default w-100"><strong>Tiến hành thanh toán</strong></a>
            </div>
            </div>
        </div>
    </div>
@endsection



