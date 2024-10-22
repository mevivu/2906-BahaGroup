<div class="card h-100">
    <div class="card-header justify-content-center">
        <h2 class="mb-0">{{ $title ?? __('Thông tin cài đặt') }}</h2>
    </div>
    <div class="row card-body wrap-loop-input">
        <p>Chọn Icon Tabler ở đây: <a target="blank" href="https://tabler.io/icons">https://tabler.io/icons</a>. Tìm Icon
            bạn thích. Ví dụ icon là alert-circle, bạn nhập vô ô dưới ti ti-alert-circle</p>
        <p>Chọn Icon Font-Awesome ở đây: <a target="blank"
                href="https://fontawesome.com/search">https://fontawesome.com/search</a>. Tìm Icon bạn thích. Ví dụ icon
            có class là fa-solid fa-house, bạn nhập vô ô dưới fa-solid fa-house</p>
        @php
            dd($settings);
        @endphp
        @foreach ($settings as $setting)
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                <div class="mb-3">
                    <label for="">{{ $setting->setting_name }}</label>
                    <x-dynamic-component :component="$setting->getNameComponentTypeInput()" :name="$setting->setting_key" :value="$setting->plain_value"
                        showImage="{{ $setting->setting_key }}" :required="true" />
                </div>
            </div>
        @endforeach
    </div>
</div>
