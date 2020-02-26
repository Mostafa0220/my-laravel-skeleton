@extends('admin.layouts.master')
@section('title', 'Edit Product')


@section('content')
    <div class="section-wrapper">

        {!! Form::model($product, [ 'route' => ['admin.products.update', $product->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data' ]) !!}
        @include('admin.products._form')
        {!! Form::close() !!}

    </div>
@endsection


