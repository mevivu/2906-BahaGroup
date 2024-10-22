<i class="{{ $value }} fs-2 ms-1"></i>
<x-select name="{{ $name }}" id="icon-select" class="select2-bs5"
				data-ajax-url="{{ route('admin.search.select.icon') }}" data-ajax-cache="true" :required="true">
				<x-select-option :option="{{ $value }}" :value="{{ $value }}" :title="{{ $value }}" />
</x-select>
