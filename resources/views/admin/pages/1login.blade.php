<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@lang('admin/global.btn.login')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('widgets.admin.styles')
        @yield('style')
        <style type="text/css">
            background-image: url('/public/templates/admin/images/background.png');
        </style>
        </head>
    <body class="hold-transition login-page">
        @include('widgets.admin.message')
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b></b>@lang('admin/global.btn.login')</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
            {{ Form::close() }}
                {{ Form::open([
                        'route' => ['admin.auth.store'],
                        'id' => 'login-form',
                        'class' => 'form-horizontal',
                        'files' => true]) }}
                        @method('POST')
                <div class="form-group has-feedback">
                    {{ Form::text(
                        'email',
                        '',
                        [
                            'class' => 'form-control',
                            'placeholder' => 'Mail'
                        ])
                    }}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {{ Form::password(
                        'password',
                        [
                            'class' => 'form-control',
                            'placeholder' => 'Mật khẩu'
                        ])
                    }}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                <div class="col-xs-8">
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('admin/global.btn.signin')</button>
                </div>
                <!-- /.col -->
                </div>
            {{ Form::close() }}

            </div>
          <!-- /.login-box-body -->
        </div>
        @include('widgets.admin.scripts')
        @yield('script')
    </body>
</html>
