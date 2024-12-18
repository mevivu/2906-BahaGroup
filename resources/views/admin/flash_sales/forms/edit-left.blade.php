<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin flash sale #:id', ['id' => $instance->id]) }}</h2>
            <x-input class="hidden-flashsale-id" type="hidden" :value="$instance->id" />
        </div>
        <div class="row card-body">
            <h3>{{ __('Thông tin chung') }}</h3>
            <div class="col-6">
                <div class="mb-3">
                    <label for=""><i class="ti ti-calendar-plus"></i>
                        {{ __('Tên của chương trình flash sale') }}</label>
                    <x-input name="name" :value="$instance->name" :required="true" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for=""><i class="ti ti-clock"></i> {{ __('Thời gian bắt đầu') }}</label>
                    <x-input type="datetime-local" :value="$instance->start_time" name="start_time" :required="true" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for=""><i class="ti ti-clock"></i> {{ __('Thời gian kết thúc') }}</label>
                    <x-input type="datetime-local" :value="$instance->end_time" name="end_time" :required="true" />
                </div>
            </div>
            <div class="col-12">
                @include('admin.flash_sales.partials.products')
            </div>
        </div>
    </div>
</div>
