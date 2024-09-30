@extends('user.layouts.master')
@section('title', __('Chi tiết đơn hàng'))
@section('content')
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row mt-3 mb-3">
                @include('user.auth.menu')
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4 col-12 border-right">
                            <h3>Chi tiết đơn hàng</h3>
                            <p><strong>Mã đơn hàng:</strong> {{ $instance->code }}</p>
                            <p><strong>Ngày đặt:</strong> {{ format_date($instance->created_at) }}</p>
                            <p><strong>Phương thức thanh toán:</strong>
                                <span
                                    @class([
                                        'badge',
                                        App\Enums\Payment\PaymentMethod::from(
                                            $instance->payment_method->value)->badge(),
                                    ])>{{ \App\Enums\Payment\PaymentMethod::getDescription($instance->payment_method->value) }}</span>
                            </p>
                            <p><strong>Địa chỉ giao hàng:</strong> {{ $instance->province->name }},
                                {{ $instance->district->name }}, {{ $instance->ward->name }}</p>
                            @if ($instance->discount_value)
                                <p><strong>Mã giảm giá được áp dụng:</strong> {{ $instance->discount->code }}</p>
                                <p><strong>Giá trị được giảm:</strong> {{ format_price($instance->discount_value) }}</p>
                            @endif
                            <p><strong>Tổng hoá đơn:</strong> {{ format_price($instance->total) }}</p>
                            <p><strong>Trạng thái:</strong>
                                <span
                                    @class([
                                        'badge',
                                        App\Enums\Order\OrderStatus::from($instance->status->value)->badge(),
                                    ])>{{ \App\Enums\Order\OrderStatus::getDescription($instance->status->value) }}</span>
                            </p>
                            <p><strong>Ghi chú:</strong> {{ $instance->note }}</p>
                        </div>

                        <!-- Thông tin người dùng -->
                        <div class="col-md-4 col-12 border-right mt-4 mt-md-0">
                            <h4>Thông tin người dùng</h4>
                            <p><strong>Tên:</strong> {{ $instance->user->fullname }}</p>
                            <p><strong>Địa chỉ:</strong> {{ $instance->user->address }}</p>
                            <p><strong>Số điện thoại:</strong> {{ $instance->user->phone }}</p>
                            <p><strong>Địa chỉ email:</strong> {{ $instance->user->email }}</p>
                        </div>

                        <!-- Thông tin khác -->
                        <div class="col-md-4 col-12 mt-4 mt-md-0">
                            <h4>Thông tin khác</h4>
                            <p><strong>Tên người nhận:</strong> {{ $instance->name_other }}</p>
                            <p><strong>Địa chỉ người nhận:</strong> {{ $instance->address_other }}</p>
                            <p><strong>Số điện thoại người nhận:</strong> {{ $instance->phone_other }}</p>
                            <p><strong>Ghi chú khác:</strong> {{ $instance->note_other }}</p>
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
                                @foreach ($instance->details as $item)
                                    <tr class="bold-text">
                                        <td data-label="Sản phẩm">
                                            <div onclick="location.href='{{ route('user.product.detail', ['id' => $item->product_id]) }}';"
                                                style="cursor: pointer" class="align-items-center product-info row">
                                                <div class="col-md-4 col-12"><img src="{{ asset($item->product->avatar) }}"
                                                        class="img-fluid card-item-img"></div>
                                                <div class="col-md-8 col-12">
                                                    <div class="product-name">{{ $item->product->name }}</div>
                                                    <div class="product-color">Xanh, 128GB</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle" data-label="Giá">{{ format_price($item->unit_price) }}
                                        </td>
                                        <td class="align-middle" data-label="Số lượng">{{ $item->qty }}</td>
                                        <td class="align-middle text-center" data-label="Tổng">
                                            {{ format_price($item->unit_price * $item->qty) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
