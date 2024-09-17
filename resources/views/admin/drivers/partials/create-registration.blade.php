<div class="card">
    <div class="card-header">
        <h4>{{ __('Thông tin Đăng ký') }}</h4>
    </div>
    <div class="row card-body">
        {{-- id_card input --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('id_card'):</label>
                <x-input name="id_card" :value="old('id_card')" :required="true"
                         :placeholder="__('id_card')"/>
            </div>
        </div>
        {{-- bank_name --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('bank_name'):</label>
                <x-input name="bank_name" :value="old('bank_name')"
                         :placeholder="__('bank_name')"/>
            </div>
        </div>
        {{-- bank_account_name --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('bank_account_name'):</label>
                <x-input name="bank_account_name" :value="old('bank_account_name')"
                         :placeholder="__('bank_account_name')"/>
            </div>
        </div>
        {{-- bank_account_number --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('bank_account_number'):</label>
                <x-input name="bank_account_number" :value="old('bank_account_number')"
                         :placeholder="__('bank_account_number')"/>
            </div>
        </div>
        <!-- address -->
        <div class="col-12">
            <div class="mb-3">
                <x-input-pick-end-address :label="trans('pickup_address')"
                                          name="end_address"
                                          :placeholder="trans('pickup_address')"
                                          :required="true"/>
                <x-input type="hidden" name="end_lat"/>
                <x-input type="hidden" name="end_lng"/>
            </div>
        </div>
        {{-- name vehicle  --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('name_vehicle'):</label>
                <x-input name="name"
                         :required="true"
                         :value="old('name')"
                         :placeholder="__('name_vehicle')"/>
            </div>
        </div>
        {{-- license_plate  --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('license_plate'):</label>
                <x-input name="license_plate" :value="old('license_plate')"
                         :placeholder="__('license_plate')"/>
            </div>
        </div>
        {{-- vehicle_company --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('vehicle_company'):</label>
                <x-input name="vehicle_company" :value="old('vehicle_company')"
                         :placeholder="__('vehicle_company')"/>
            </div>
        </div>
        <!-- color -->
        <div class="col-md-6 col-sm-12">
            <div class="mb-3">
                <label class="control-label">{{__('Màu sắc')}}:</label>
                <x-input name="color" :value="old('color')"
                         :required="true"
                         placeholder="{{__('Màu sắc')}}"/>
            </div>
        </div>
        <!-- type -->
        <div class="col-md-6 col-sm-12">
            <div class="mb-3">
                <label class="control-label">{{__('Loại xe')}}:</label>
                <x-select name="type" :required="true">
                    @foreach ($type as $key => $value)
                        <x-select-option :value="$key" :title="$value"/>
                    @endforeach
                </x-select>
            </div>
        </div>
        <!-- seat_number -->
        <div class="col-md-6 col-sm-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Số chổ ngồi') }}:</label>
                <x-input type="number" name="seat_number"
                         :value="old('seat_number')"
                         :required="true"
                         placeholder="{{ __('Số chổ ngồi') }}"/>
            </div>
        </div>
        {{-- amenities --}}
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label"><strong>{{ __('amenities') }}:</strong></label>
                <textarea name="amenities"
                          class="ckeditor visually-hidden">
                    {{ old('amenities') }}
                </textarea>
            </div>
        </div>
        {{-- description --}}
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label"><strong>{{ __('description') }}:</strong></label>
                <textarea name="description"
                          class="ckeditor visually-hidden">
                      {{ old('description') }}
                </textarea>
            </div>
        </div>
        {{-- vehicle_registration_front --}}
        <div class="col-md-6 col-12">
            <div class="card mb-3">
                <div class="card-header">
                    @lang('vehicle_registration_front')
                </div>
                <div class="card-body p-2">
                    <x-input-image-ckfinder name="vehicle_registration_front"
                                            :value="old('vehicle_registration_front')"
                                            showImage="featureImageVehicleRegistrationFront"/>
                </div>
            </div>
        </div>
        {{-- vehicle_registration_back --}}
        <div class="col-md-6 col-12">
            <div class="card mb-3">
                <div class="card-header">
                    @lang('vehicle_registration_back')
                </div>
                <div class="card-body p-2">
                    <x-input-image-ckfinder name="vehicle_registration_back"
                                            :value="old('vehicle_registration_back')"
                                            showImage="featureImageVehicleRegistrationBack"/>
                </div>
            </div>
        </div>
        {{-- insurance_front_image --}}
        <div class="col-md-6 col-12">
            <div class="card mb-3">
                <div class="card-header">
                    @lang('insurance_front_image')
                </div>
                <div class="card-body p-2">
                    <x-input-image-ckfinder name="insurance_front_image" :value="old('insurance_front_image')"
                                            showImage="featureImageInsuranceFront"/>
                </div>
            </div>
        </div>
        {{-- insurance_back_image --}}
        <div class="col-md-6 col-12">
            <div class="card mb-3">
                <div class="card-header">
                    @lang('insurance_back_image')
                </div>
                <div class="card-body p-2">
                    <x-input-image-ckfinder name="insurance_back_image" :value="old('insurance_back_image')"
                                            showImage="featureImageInsuranceBack"/>
                </div>
            </div>
        </div>
        {{-- vehicle_front_image --}}
        <div class="col-md-6 col-12">
            <div class="card mb-3">
                <div class="card-header">
                    @lang('vehicle_front_image')
                </div>
                <div class="card-body p-2">
                    <x-input-image-ckfinder name="vehicle_front_image" :value="old('vehicle_front_image')"
                                            showImage="featureImageVehicleFront"/>
                </div>
            </div>
        </div>
        {{-- vehicle_back_image --}}
        <div class="col-md-6 col-12">
            <div class="card mb-3">
                <div class="card-header">
                    @lang('vehicle_back_image')
                </div>
                <div class="card-body p-2">
                    <x-input-image-ckfinder name="vehicle_back_image" :value="old('vehicle_back_image')"
                                            showImage="featureImageVehicleBack"/>
                </div>
            </div>
        </div>
        {{-- vehicle_side_image --}}
        <div class="col-md-6 col-12">
            <div class="card mb-3">
                <div class="card-header">
                    @lang('vehicle_side_image')
                </div>
                <div class="card-body p-2">
                    <x-input-image-ckfinder name="vehicle_side_image" :value="old('vehicle_side_image')"
                                            showImage="featureImageVehicleSide"/>
                </div>
            </div>
        </div>
        {{-- vehicle_interior_image --}}
        <div class="col-md-6 col-12">
            <div class="card mb-3">
                <div class="card-header">
                    @lang('vehicle_interior_image')
                </div>
                <div class="card-body p-2">
                    <x-input-image-ckfinder name="vehicle_interior_image" :value="old('vehicle_interior_image')"
                                            showImage="featureImageVehicleInterior"/>
                </div>
            </div>
        </div>
    </div>
</div>
