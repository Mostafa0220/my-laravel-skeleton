@extends('admin.layouts.master')
@push('styles')
    <link rel="stylesheet" href="{{  asset('/public/lib/summernote/css/summernote-bs4.css') }}">
@endpush



@section('title', 'Edit App Settings')


@section('content')
    <div class="section-wrapper">


        {!! Form::open([ 'route' => 'admin.settings.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        @include('admin.settings._form')
        {!! Form::close() !!}

    </div>
@endsection
@push('scripts')

    <script src="{{ asset('/public/lib/summernote/js/summernote-bs4.min.js') }}"></script>
    <script>
        $(function () {
            'use strict';

            // Summernote editor
            $('#about').summernote({
                height: 150,
                tooltip: false
            }),
                $('#privacy').summernote({
                    height: 150,
                    tooltip: false
                }),
                $('#policy').summernote({
                    height: 150,
                    tooltip: false
                }),
                $('#terms').summernote({
                    height: 150,
                    tooltip: false
                }),
                $('#login_welcome').summernote({
                    height: 150,
                    tooltip: false
                })
        });
    </script>
@endpush

