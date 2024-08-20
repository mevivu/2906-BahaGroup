@extends('admin.layouts.master')

@push('libs-css')
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h2 class="mb-0">@lang('list')</h2>
                    <x-link :href="route('admin.store.create')" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        <span class="ms-1">@lang('add')</span>
                    </x-link>
                </div>
                <div class="card-body">
                    <div class="table-responsive position-relative">
                        <x-admin.partials.toggle-column-datatable />
                        {{$dataTable->table(['class' => 'table table-bordered'], true)}}
                    </div>
                </div>
        </div>
    </div>
@endsection

@push('libs-js')
<script src="{{ asset('/public/libs/select2/dist/js/select2.min.js') }}"></script>

<!-- button in datatable -->

<script src="{{ asset('/public/vendor/datatables/buttons.server-side.js') }}"></script>
@endpush

@push('custom-js')

{{ $dataTable->scripts() }}

@include('admin.scripts.datatable-toggle-columns', [
    'id_table' => $dataTable->getTableAttribute('id')
])
@endpush
