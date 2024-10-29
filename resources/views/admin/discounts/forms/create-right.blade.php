<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-playstation-circle"></i><span class="ms-2">@lang('action')</span>
        </div>

        <div class="card-body p-2">
            <div class="d-flex align-items-center h-100 gap-2">
                <x-button.submit :title="__('save')" name="submitter" value="save" />
                {{-- <x-button type="submit" name="submitter" value="saveAndExit">
                    @lang('save&exit')
                </x-button> --}}
            </div>
        </div>
    </div>
</div>
