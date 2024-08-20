<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            @lang('action')
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <div class="d-flex align-items-center h-100 gap-2">
                <x-button.submit :title="__('save')" name="submitter" value="save"/>
                <x-button type="submit" name="submitter" value="saveAndExit">
                    @lang('save&exit')
                </x-button>
            </div>
            <x-button.modal-delete data-route="{{ route('admin.store.delete', $store->id) }}"
                                   :title="__('delete')"/>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            @lang('storeCategory')
        </div>
        <div class="card-body p-2 wrap-select2">
            <x-select name="category_id"
                      class="select2-bs5-ajax"
                      id="category_id"
                      :data-url="route('admin.search.select.store_category')"
                      :required="true">
                @if(isset($store->category))
                    <x-select-option :option="$store->category_id" :value="$store->category_id" :title="$store->category->name"/>
                @else
                    <x-select-option :option="$store->category_id" :value="$store->category_id" :title="'N/A'"/>
                @endif
            </x-select>
        </div>

    </div>
    <div class="card mb-3">
        <div class="card-header">
            @lang('area')
        </div>
        <div class="card-body p-2 wrap-select2">
            <x-select name="area_id"
                      class="select2-bs5-ajax"
                      id="area_id"
                      :data-url="route('admin.search.select.area')"
                      :required="true">
                <x-select-option :option="$store->area_id" :value="$store->area_id" :title="$store->area->name ?? 'N/A'"/>
            </x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            @lang('status')
        </div>
        <div class="card-body p-2">
            <x-select name="status" :required="true">
                @foreach ($status as $key => $value)
                    <x-select-option :option="$store->status->value" :value="$key" :title="__($value)"/>
                @endforeach
            </x-select>
        </div>
    </div>
{{--    <div class="card mb-3">--}}
{{--        <div class="card-header">--}}
{{--            @lang('priority')--}}
{{--        </div>--}}
{{--        <div class="card-body p-2">--}}
{{--            <x-input type="number" name="priority" :value="$store->priority" :placeholder="trans('priority')"/>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- avatar -->
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header">
                @lang('avatar')
            </div>
            <div class="card-body p-2">
                <x-input-image-ckfinder name="logo"
                                        showImage="logo"
                                        class="img-fluid"
                                        :value="$store->logo" />
            </div>
        </div>
    </div>
</div>
