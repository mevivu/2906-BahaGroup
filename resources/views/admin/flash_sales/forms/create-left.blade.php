<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin flash sale') }}</h2>
        </div>
        <div class="row card-body">
            <h3>{{ __('Thông tin chung') }}</h3>
            <div class="col-6">
                <div class="mb-3">
                    <label for=""><i class="ti ti-calendar-plus"></i> {{ __('Tên của chương trình flash sale') }}
                        <span class="text-danger">*</span></label>
                    <x-input name="name" :value="old('name')" :required="true" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for=""><i class="ti ti-clock"></i> {{ __('Thời gian bắt đầu') }} <span
                            class="text-danger">*</span></label>
                    <x-input type="datetime-local" :value="old('start_time')" onblur="checkDate(this)" name="start_time"
                        :required="true" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for=""><i class="ti ti-clock"></i> {{ __('Thời gian kết thúc') }} <span
                            class="text-danger">*</span></label>
                    <x-input type="datetime-local" :value="old('end_time')" onblur="checkDate(this)" name="end_time"
                        :required="true" />
                </div>
            </div>
            <div class="col-12">
                @include('admin.flash_sales.partials.products')
            </div>
        </div>
    </div>
</div>

<script>
    function checkDate(element) {
        var inputDate = new Date(element.value);
        var currentDate = new Date();
        if (inputDate < currentDate) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi ngày giờ!',
                text: 'Ngày bắt đầu/kết thúc không được nhỏ hơn ngày hiện tại.',
                showConfirmButton: true,
                confirmButtonColor: "#1c5639",
            });
            element.value = "";
            return;
        }

        var endDateInput = document.querySelector('[name="end_time"]');
        if (endDateInput) {
            var endDate = new Date(endDateInput.value);
            if (inputDate > endDate) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi ngày giờ!',
                    text: 'Ngày bắt đầu phải trước ngày kết thúc.',
                    showConfirmButton: true,
                    confirmButtonColor: "#1c5639",
                });
                element.value = "";
                return;
            }
        }
    }
</script>
