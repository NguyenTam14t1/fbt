<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">Star travel </span>
        <!-- logo for regular state and mobile devices -->
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
                        <img src="{{ Auth()->user()->avatar_path }}" class="avatar" style="height: 30px; width: 30px; border-radius: 50%; margin-right: 5px;">
                    </a>
                    <ul class="dropdown-menu" style="width: 200px">
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user"></i> <span>Tài khoản</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-key"></i> <span>Đổi mật khẩu</span>
                                    </a>
                                </li>
                                 <li>
                                    <a href="{{  route('admin.auth.logout') }}">
                                        <i class="fa fa fa-book"></i> <span>Đăng xuất</span>
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
