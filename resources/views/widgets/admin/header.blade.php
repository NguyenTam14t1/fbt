<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">NAG</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img class="logo logo-sidebar" src="{{ asset('/images/logo.png') }}"></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src=#" class="user-image" alt="User Image">
                    </a>
                    <ul class="dropdown-menu" style="width: 200px">
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user"></i> <span>@lang('admin/user.sidebar_profile')</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-key"></i> <span>@lang('admin/user.sidebar_password_change')</span>
                                    </a>
                                </li>
                                 <li>
                                    <a href="{{  route('admin.auth.logout') }}">
                                        <i class="fa fa fa-book"></i> <span>@lang('admin/auth.logout')</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>