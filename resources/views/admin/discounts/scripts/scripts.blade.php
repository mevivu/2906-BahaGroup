
<script>
    $(document).ready(function(e) {
        select2LoadData($('#user_id').data('url'), '#user_id');
        select2LoadData($('#store_id').data('url'), '#store_id');
        select2LoadData($('#driver_id').data('url'), '#driver_id');
        select2LoadData($('#product_id').data('url'), '#product_id');
    });
</script>
