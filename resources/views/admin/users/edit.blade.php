@extends('admin.layouts.master')
@if(empty($title))
    @section('title', 'Edit User')
@else
    @section('title', $title)
@endif


@section('content')
<div class="section-wrapper">

    {!! Form::model($user, [ 'route' => ['admin.users.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data' ]) !!}
        @include('admin.users._form')
    {!! Form::close() !!}

</div>
@endsection


