<div class="col-12 col-md-9">
    <div class="row">
        <!-- name -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label"><i class="ti ti-brand-producthunt"></i> {{ __('Tên sản phẩm') }}: <span
                        class="text-danger">*</span></label>
                <x-input name="product[name]" :value="old('product.name')" :required="true"
                    placeholder="{{ __('Tên sản phẩm') }}" />
            </div>
        </div>

        <!-- desc -->
        <div class="col-12">
            <div class="mb-3">
                <label class="control-label"><i class="ti ti-file-description"></i> {{ __('Mô tả') }}:</label>
                <textarea name="product[desc]" class="ckeditor visually-hidden">{{ old('product.desc') }}</textarea>
            </div>
        </div>
        <!-- data -->
        <div class="col-12">
            @include('admin.products.data.data-product')
        </div>
    </div>
</div>
