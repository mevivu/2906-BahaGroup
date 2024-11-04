<script>
    $(document).ready(function() {
        select2LoadData($('#user_id').data('url'), '#user_id');
        let selectedValue = null;
        $('.notification-type').change(function() {
            selectedValue = $(this).val();
            $('#notification-customer-select').hide();
            if (selectedValue == {{ \App\Enums\Notification\NotificationType::Customer }}) {
                $('#notification-customer-select').show();
            }
        });
    });
</script>
