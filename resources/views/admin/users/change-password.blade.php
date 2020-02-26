@extends('admin.layouts.master')
@section('title', 'Change Password')

@section('content')
    <div class="section-wrapper">


        {!! Form::open(array('url' => 'administrator/users/store-password')) !!}

        <div class="form-group">
            <label>Current Password</label>
            {!! Form::password('current_password', [ 'class' => 'form-control', 'autocomplete' => 'current-password' ]) !!}
        </div>

        <div class="form-group">
            <label> New Password </label>
            {!! Form::password('new_password', [ 'class' => 'form-control', 'autocomplete' => 'current-password' ]) !!}
        </div>
        <div class="form-group">
            <label> Confirm New Password </label>
            {!! Form::password('new_confirm_password', [ 'class' => 'form-control' , 'autocomplete' => 'current-password' ]) !!}
        </div>

        <div class="form-group">
            <button class="btn btn-primary"> Change Password</button>
        </div>

        {!! Form::close() !!}

    </div>
@endsection
