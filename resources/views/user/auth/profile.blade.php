@extends('user.layouts.master')
@section('title', __('Thông tin cá nhân'))
@section('content')
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row mb-3 mt-3">
                @include('user.auth.menu')
                <div class="col-md-10">
                    <x-form :action="route('user.profile.update')" type="put" enctype="multipart/form-data" :validate="true">
                        <div class="row">
                            <!-- Họ và tên -->
                            <div class="col-md-6">
                                <label for="fullName">Họ và tên <p style="display: inline;" class="text-red">*</p></label>
                                <x-input name="fullname" :value="$auth->fullname" :required="true"
                                    placeholder="{{ __('Ví dụ: Phạm Minh Mạnh') }}" />
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email">Email <p style="display: inline;" class="text-red">*</p></label>
                                <x-input-email name="email" :value="$auth->email" :required="true" />
                            </div>

                            <!-- Số điện thoại -->
                            <div class="col-md-6 mt-3">
                                <label for="phone">Số điện thoại <p style="display: inline;" class="text-red">*</p>
                                    </label>
                                <x-input-phone name="phone" :value="$auth->phone" :required="true" />
                            </div>

                            <!-- Ngày sinh -->
                            <div class="col-md-3 mt-3">
                                <label for="dob">Ngày sinh <p style="display: inline;" class="text-red">*</p></label>
                                <x-input type="date" name="birthday" :value="isset($auth->birthday) ? format_date($auth->birthday, 'Y-m-d') : null" :required="true" />
                            </div>

                            <!-- Giới tính -->
                            <div class="col-md-3 mt-3">
                                <label for="gender">Giới tính <p style="display: inline;" class="text-red">*</p></label>
                                <x-select name="gender" :required="true">
                                    <x-select-option value="" :title="__('Chọn Giới tính')" />
                                    @foreach ($gender as $key => $value)
                                        <x-select-option :option="$auth->gender->value" :value="$key" :title="__($value)" />
                                    @endforeach
                                </x-select>
                            </div>

                            <!-- Địa chỉ -->
                            <div class="col-md-12 mt-3">
                                <x-input :label="trans('address')" name="address" :value="$auth->address" :placeholder="trans('address')"
                                    :required="true" />
                                <x-input type="hidden" name="lat" :value="$auth->lat" />
                                <x-input type="hidden" name="lng" :value="$auth->lng" />
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"><button type="submit" class="btn btn-default w-100 mt-2"><strong>CẬP
                                        NHẬT</strong></button></div>
                            <div class="col-md-4"></div>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
    @include('admin.layouts.modal.modal-pick-address')
    @include('admin.scripts.google-map-input')
@endpush
