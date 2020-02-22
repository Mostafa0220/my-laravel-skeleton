@extends('admin.layouts.master')
@section('title', 'Create User')

@section('content')
<div class="section-wrapper">

    {!! Form::open([ 'route' => 'admin.users.store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
        @include('admin.users._form')
    {!! Form::close() !!}

</div>
@endsection
