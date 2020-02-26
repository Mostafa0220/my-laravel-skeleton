@extends('admin.layouts.master')

@section('title')
    Create Product
@endsection

@section('content')
<div class="section-wrapper">

    {!! Form::open([ 'route' => 'admin.products.store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
    @include('admin.products._form')
    {!! Form::close() !!}

</div>
@endsection

