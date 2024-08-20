<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
    <i class="ti ti-plus"></i> {{ __('Thêm chi tiết') }}
</button>
<div id="tableProduct" class="table table-transparent table-responsive">
        @each('admin.flash_sales.partials.item-product', $instance->details ?? [], 'flash_sale_detail')
</div>
