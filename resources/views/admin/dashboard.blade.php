@extends('admin.layouts.master')

@section('content')
    Welcome Back {{ Auth::user()->name }}
@endsection
