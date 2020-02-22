@extends('admin.layouts.master')
@if(!isset($title)) $title ='Edit User' @endif

@section('title', $title)


@section('content')
<div class="section-wrapper">

    {!! Form::model($user, [ 'route' => ['admin.users.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data' ]) !!}
        @include('admin.users._form')
    {!! Form::close() !!}

</div>
@endsection


