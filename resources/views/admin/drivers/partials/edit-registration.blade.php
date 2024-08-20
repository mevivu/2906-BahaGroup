<div class="card">
    <div class="card-header">
        <h4>{{ __('Thông tin Đăng ký') }}</h4>
    </div>
    <div class="row card-body">
        <div class="col-12">
            <div class="mb-3">
                <x-input-pick-end-address :label="trans('pickup_address')"
                                          name="end_address"
                                          :placeholder="trans('pickAddress')"
                                          :value="$driver->current_address"
                                          :required="true"/>
                <x-input type="hidden" name="end_lat" :value="$driver->current_lat"/>
                <x-input type="hidden" name="end_lng" :value="$driver->current_lng"/>
            </div>
        </div>
        {{-- id_card input --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('id_card'):</label>
                <x-input name="id_card" :value="$driver->id_card ?? old('id_card')" :required="true"
                         :placeholder="__('id_card')"/>
            </div>
        </div>
        {{-- bank_name input --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('bank_name'):</label>
                <x-input name="bank_name" :value="$driver->bank_name ?? old('bank_name')"
                         :placeholder="__('bank_name')"/>
            </div>
        </div>
        {{-- bank_account_name input --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('bank_account_name'):</label>
                <x-input name="bank_account_name" :value="$driver->bank_account_name ?? old('bank_account_name')"
                         :placeholder="__('bank_account_name')"/>
            </div>
        </div>
        {{-- bank_account_number input --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('bank_account_number'):</label>
                <x-input name="bank_account_number"
                         :value="$driver->bank_account_number ?? old('bank_account_number')"
                         :placeholder="__('bank_account_number')"/>
            </div>
        </div>
        {{-- Tên phương tiện --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Tên phương tiện') }}:</label>
                <x-input name="name" :value="$driver->vehicle->name ?? old('name')"
                         :placeholder="__('Tên phương tiện')"/>
            </div>
        </div>
        {{-- license_plate input --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('license_plate'):</label>
                <x-input name="license_plate" :value="$driver->vehicle->license_plate ?? old('license_plate')"
                         :placeholder="__('license_plate')"/>
            </div>
        </div>
        {{-- vehicle_company input --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">@lang('vehicle_company'):</label>
                <x-input name="vehicle_company" :value="$driver->vehicle->vehicle_company ?? old('vehicle_company')"
                         :placeholder="__('vehicle_company')"/>
            </div>
        </div>
        {{-- Màu sắc --}}
        <div class="col-md-6 col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Màu sắc') }}:</label>
                <x-input name="color" :value="$driver->vehicle->color ?? old('color')"
                         :placeholder="__('Màu sắc')"/>
            </div>
        </div>
        {{-- Loại xe --}}
        <div class="col-md-6 col-sm-12">
            <div class="mb-3">
                <label class="control-label">{{__('Loại xe')}}:</label>
                <x-select name="type" :required="true">
                    @foreach ($type as $key => $value)
                        <x-select-option :option="$driver->vehicle->type->value" :value="$key" :title="$value"/>
                    @endforeach
                </x-select>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Số chỗ ngồi') }}:</label>
                <x-input type="number" name="seat_number"
                         :value="$driver->vehicle->seat_number ?? old('seat_number')"
                         :required="true"
                         placeholder="{{ __('Số chỗ ngồi') }}"/>
            </div>
        </div>
        {{-- amenities --}}
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label"><strong>{{ __('amenities') }}:</strong></label>
                <textarea name="amenities"
                          class="ckeditor visually-hidden">
                    {{ $driver->vehicle->amenities ?? old('amenities') }}
                </textarea>
            </div>
        </div>
        {{-- description --}}
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label"><strong>{{ __('description') }}:</strong></label>
                <textarea name="description"
                          class="ckeditor visually-hidden">
                          {{ $driver->vehicle->description ?? old('description') }}
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
                    <x-input-image-ckfinder
                        name="vehicle_registration_front"
                        :value="$driver->vehicle->vehicle_registration_front"
                        showImage="featureImageVehicleRegistrationFront"
                    />
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
                    <x-input-image-ckfinder
                        name="vehicle_registration_back"
                        :value="$driver->vehicle->vehicle_registration_back"
                        showImage="featureImageVehicleRegistrationBack"
                    />
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
                    :value="$driver->vehicle->insurance_front_image"
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
                    :value="$driver->vehicle->insurance_back_image"
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
                    :value="$driver->vehicle->vehicle_front_image"
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
                    :value="$driver->vehicle->vehicle_back_image"
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
                    :value="$driver->vehicle->vehicle_side_image"
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
                    :value="$driver->vehicle->vehicle_interior_image"
                    showImage="featureImageVehicleInterior"/>
                </div>
            </div>
        </div>
    </div>
</div>

