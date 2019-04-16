<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="app-lang" content="{{ env('APP_LANG', 'en') }}">
        @routes
        @include('widgets.admin.styles')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('widgets.admin.header')
            @include('widgets.admin.sidebar')
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('widgets.admin.footer')
            <div class="control-sidebar-bg"></div>
        </div>
        @include('widgets.admin.scripts')
    </body>
</html>
