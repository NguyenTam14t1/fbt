@extends ('widgets.bookingtour.master')

@section('change-header', 'changeHeader1')
@section('header-type', 'lightHeader lightHeader1')

@section ('content')
    <!-- DASHBOARD MENU  -->
    <section class="dashboardMenu">
        <nav class="navbar dashboradNav">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav dashboardNavLeft">
                        <li><a class="@yield('active-1')" href="{{ route('client.user.index') }}"><i class="fa fa-tachometer" aria-hidden="true"></i>@lang('lang.dashboard')</a></li>
                        <li><a class="@yield('active-2')" href="{{ route('client.user.manager.show', [$data['user']->id, config('setting.booking_all')]) }}"><i class="fa fa-cube" aria-hidden="true"></i>@lang('lang.booking')</a></li>
                        <li><a class="@yield('active-3')" href="{{ route('client.user.edit', $data['user']->id) }}" class="@yield('content-3')"><i class="fa fa-user" aria-hidden="true"></i>@lang('lang.profile')</a></li>
                        <li><a class="@yield('active-3')" href="{{ route('changepass') }}"><i class="fa fa-cogs" aria-hidden="true"></i>Đổi mật khẩu</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>
    </section>

    @yield('main-content')
@endsection
