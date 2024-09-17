@extends('user.layouts.master')
@section('title', __('Đơn hàng'))

@section('content')
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row mt-3 mb-3">
                @include('user.auth.menu')
                <div class="col-md-10 col-12">
                    <div class="table-responsive position-relative">
                        <x-admin.partials.toggle-column-datatable />
                        {{$dataTable->table(['class' => 'table table-bordered', 'style' => 'min-width: 900px;'], true)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('libs-js')
<!-- button in datatable -->
<script src="{{ asset('/public/vendor/datatables/buttons.server-side.js') }}"></script>
@endpush

@push('custom-js')

{{ $dataTable->scripts() }}

@include('admin.scripts.datatable-toggle-columns', [
        'id_table' => $dataTable->getTableAttribute('id')
])

@include('admin.orders.scripts.scripts')

@endpush
