@extends('user.layouts.master')
@section('title', __('Thanh toán'))

@section('content')
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12 mt-3">
                    <h4>Thông tin thanh toán</h4>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Nhập họ và tên">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập email">
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Ghi chú</label>
                        <textarea class="form-control" id="note" rows="3" placeholder="Nhập ghi chú"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input ms-3" type="checkbox" id="showDetails">
                        <label class="form-check-label" for="showDetails">
                            Giao đến địa chỉ khác
                        </label>
                    </div>
                    <div id="details" style="display: none;">
                        <div class="mb-3">
                            <label for="otherFullName" class="form-label">Họ và tên khác</label>
                            <input type="text" class="form-control" id="otherFullName" placeholder="Nhập họ và tên khác">
                        </div>
                        <div class="mb-3">
                            <label for="otherAddress" class="form-label">Địa chỉ khác</label>
                            <input type="text" class="form-control" id="otherAddress" placeholder="Nhập địa chỉ khác">
                        </div>
                        <div class="mb-3">
                            <label for="otherPhone" class="form-label">Số điện thoại khác</label>
                            <input type="text" class="form-control" id="otherPhone" placeholder="Nhập số điện thoại khác">
                        </div>
                        <div class="mb-3">
                            <label for="otherNote" class="form-label">Ghi chú khác</label>
                            <textarea class="form-control" id="otherNote" rows="3" placeholder="Nhập ghi chú khác"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12 mt-3">
                    <h4>Đơn đặt hàng</h4>
                    <div class="mt-4">
                        <table class="table justify-content-center">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-end">Tạm tính</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bold-text">
                                    <td data-label="Sản phẩm">
                                        <div onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" style="cursor: pointer" class="align-items-center product-info row">
                                            <div class="col-md-3 col-12"><img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" class="img-fluid card-item-img"></div>
                                            <div class="col-md-9 col-12">
                                                <div class="product-name">Tên sản phẩm 1 <span style="color: #777777">(x10)</span></div>
                                                <div class="product-color">Xanh, 128GB</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Tổng">1,000,000₫</td>
                                </tr>
                                <tr class="bold-text">
                                    <td data-label="Sản phẩm">
                                        <div onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" style="cursor: pointer" class="align-items-center product-info row">
                                            <div class="col-md-3 col-12"><img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" class="img-fluid card-item-img"></div>
                                            <div class="col-md-9 col-12">
                                                <div class="product-name">Tên sản phẩm 1 <span style="color: #777777">(x10)</span></div>
                                                <div class="product-color">Xanh, 128GB</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Tổng">1,000,000₫</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-6 text-start">Tạm tính</div>
                        <div class="col-6 text-end"><strong>2,210,000đ</strong></div>
                        <div class="col-6 text-start">Giao hàng</div>
                        <div class="col-6 text-end">Giao hàng miễn phí</div>
                        <div class="col-6 text-start mt-5">Tổng</div>
                        <div class="col-6 text-end mt-5 mb-3"><strong>2,210,000đ</strong></div>
                    </div>
                    <h4>Phương thức thanh toán</h4>
                    <div class="col-12 mt-4">
                        <div class="form-check">
                            <input class="form-check-input ms-2" type="radio" name="paymentMethod" id="bankTransfer" value="bankTransfer" checked>
                            <label class="form-check-label" for="bankTransfer">
                                Chuyển khoản ngân hàng
                            </label>
                        </div>
                        <p style="color: #777777">Thực hiện thanh toán vào ngay tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng Mã đơn hàng của bạn trong phần Nội dung thanh toán. Đơn hàng sẽ được giao sau khi tiền đã chuyển.</p>
                        <div class="form-check">
                            <input class="form-check-input ms-2" type="radio" name="paymentMethod" id="cashOnDelivery" value="cashOnDelivery">
                            <label class="form-check-label" for="cashOnDelivery">
                                Trả tiền mặt khi nhận hàng
                            </label>
                        </div>
                    </div>
                    <a class="btn btn-default w-100 mb-3"><strong>Đặt hàng</strong></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('showDetails').addEventListener('change', function() {
            var details = document.getElementById('details');
            if (this.checked) {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        });
    </script>
@endsection



