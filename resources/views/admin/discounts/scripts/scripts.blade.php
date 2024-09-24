
<script>
        function checkStartDate(input) {
            const endDateInput = document.querySelector('input[name="date_end"]');
            const startDate = new Date(input.value);
            const endDate = new Date(endDateInput.value);
            const currentDate = new Date();

            if (startDate > currentDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lưu ý',
                    text: 'Ngày bắt đầu phải lớn hơn ngày hiện tại!',
                    showConfirmButton: true
                });
                input.value = '';
                return;
            }

            if (endDate < startDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lưu ý',
                    text: 'Ngày bắt đầu không được nhỏ hơn ngày kết thúc!',
                    showConfirmButton: true
                });
                input.value = '';
                return;
            }
        }

        function checkEndDate(input) {
            const startDateInput = document.querySelector('input[name="date_start"]');
            const endDate = new Date(input.value);
            const startDate = new Date(startDateInput.value);
            const currentDate = new Date();

            if (endDate < startDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lưu ý',
                    text: 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu!',
                    showConfirmButton: true
                });
                input.value = '';
                return;
            }

            if (endDate < currentDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lưu ý',
                    text: 'Ngày kết thúc phải lớn hơn ngày hiện tại!',
                    showConfirmButton: true
                });
                input.value = '';
                return;
            }
        }

        function checkDiscountValue(input) {
            const type = document.querySelector('select[name="type"]');
            if(type.value == {{ App\Enums\Discount\DiscountType::Percent->value }}){
                const value = parseInt(input.value);
                if(value < 0 || value > 100){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Lưu ý',
                        text: 'Giá trị phải lớn hơn 0 và nhỏ hơn 100 khi loại giảm là phần trăm!',
                        showConfirmButton: true
                    });
                    input.value = '';
                    return;
                }
            }
        }

        $(document).ready(function() {
            $('select[name="type"]').on('change', function() {
                $('input[name="discount_value"]').val('');
            });
        });

</script>
