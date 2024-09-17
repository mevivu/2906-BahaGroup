<script>
    $(document).on('click', '#cancel-order', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        Swal.fire({
            title: "Bạn có chắc chắn muốn hủy đơn này?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Chắc chắn!",
            cancelButtonText: "Quay lại!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>
