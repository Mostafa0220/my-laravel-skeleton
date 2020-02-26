@extends('admin.layouts.master')
@section('title')
    Products
    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary "> <i
            class="fa fa-plus"></i> Add New </a>
@endsection
@section('content')
    <div class="section-wrapper">
        @component('admin.components.datatables', [
            'name' => 'data-tables',
            'thead' => [  __('Name'), __('Description'), __('Created at'), __('Action') ],
            'options' => [
                'processing' => true,
                'serverSide' => true,
                'ajax' => route('admin.products.index'),
                'columns' => [
                    ['data' => 'name'],
                    ['data' => 'description'],
                    ['data' => 'created_at'],
                    ['data' => 'action', 'class' => 'text-right'],
                ]
            ]
        ])
        @endcomponent

    </div>
@endsection


@push('styles')

@endpush


@push('scripts')

    <link rel="stylesheet" href="{{  asset('/css/alertify.min.css') }}">
    <link rel="stylesheet" href="{{  asset('/css/alertify-themes/bootstrap.min.css') }}">
    <script src="{{ asset('/js/alertify.min.js') }}"></script>



@endpush



