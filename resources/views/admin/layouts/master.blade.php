<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if(Session::get('appSettings')->app_title)
            {{Session::get('appSettings')->app_title}}
        @else
            {{ env('APP_NAME')}}
        @endif
        - {{str_replace('-', ' ', ucwords(Request::segment(2)))}}
        @if(Request::segment(3))
            :: {{str_replace('-', ' ', ucwords(Request::segment(3)))}}
        @endif
    </title>

    <link rel="stylesheet" href="{{  asset('/css/admin.css') }}">

    @stack('styles')
</head>

<body>
<div id="app">
    <div class="slim-header with-sidebar">
        <div class="container-fluid">
            <div class="slim-header-left">
                <h2 class="slim-logo">

                    <a href="{{ url('/admin/report/dashboard') }}">
                        @if(Session::get('appSettings')->company_name)
                            {{Session::get('appSettings')->company_name}}
                        @else
                            {{ env('APP_NAME')}}
                        @endif
                        <span>.</span>
                    </a>
                </h2>
                <a href="" id="slimSidebarMenu" class="slim-sidebar-menu"><span></span></a>
            </div>
            <div class="slim-header-right">

                <div class="dropdown dropdown-c">
                    <a href="#" class="logged-user" data-toggle="dropdown">
                        @if(auth()->user()->avatar)

                            <img
                                src="{{ asset('storage/app/avatars/' .\Illuminate\Support\Facades\Auth::user()->avatar) }}"
                                alt="">
                        @else
                            <img src="{{ asset('images/avatars/admins/admins.png') }}"
                                 alt="">
                        @endif
                        <span>{{ auth()->user()->name }}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <nav class="nav">
                            <a href="{{ url('/administrator/users/profile') }}" class="nav-link"><i
                                    class="icon ion-person"></i>
                                View Profile</a>
                            <a href="{{ url('/administrator/logout') }}" class="nav-link"><i
                                    class="icon ion-forward"></i> Sign Out</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="slim-body">
        <div class="slim-sidebar">
            <label class="sidebar-label">Navigation</label>
            {{-- Menu Navigation --}}
            @include('admin.layouts.partials.sidebar')
            {{-- End Menu Navigation --}}
        </div>
        <div class="slim-mainpanel">
            <div class="container">
                @include('admin.layouts.alert')
                @include('admin.components.breadcrumb')
                @yield('content')
            </div>
            @yield('footer')
            <div class="slim-footer mg-t-0">
                <div class="container-fluid">

                    <p>{{ now()->format('Y') }} &copy; All Rights Reserved. {{ env('APP_NAME') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/js/admin.js') }}"></script>
@stack('scripts')
</body>

</html>
