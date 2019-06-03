<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="{{set_active(['admin.dashboard.*'])}}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Thống kê</span>
                </a>
            </li>

            <li class="treeview {{set_active(['admin.tour.*'])}}">
                <a href="#">
                    <i class="glyphicon glyphicon-th-list"></i><span>Quản lý tour</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{set_active(['admin.tour.index'])}}">
                        <a href="{{ route('admin.tour.index') }}">
                            <i class="fa fa-mountains"></i>
                            <span>Danh sách</span>
                        </a>
                    </li>
                    <li class="{{set_active(['admin.tour.create'])}}">
                        <a href="{{ route('admin.tour.create') }}">
                            <i class="fa fa-cat"></i>
                            <span>Tạo mới</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{set_active(['admin.booking.*'])}}">
                <a href="{{ route('admin.booking.index') }}">
                    <i class="glyphicon glyphicon-check"></i>
                    <span>Quản lý đặt tour</span>
                </a>
            </li>

            <li class="{{set_active(['admin.hotel.*'])}}">
                <a href="{{ route('admin.hotel.index') }}">
                    <i class="glyphicon glyphicon-home"></i>
                    <span>Quản lý khách sạn</span>
                </a>
            </li>

            <li class="treeview {{set_active(['admin.guide.*'])}}">
                <a href="#">
                    <i class="fa fa-guide"></i><span>Quản lý hướng dẫn viên</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{set_active(['admin.guide.index'])}}">
                        <a href="{{ route('admin.guide.index') }}">
                            <i class="fa fa-mountains"></i>
                            <span>Danh sách</span>
                        </a>
                    </li>
                    <li class="{{set_active(['admin.guide.create'])}}">
                        <a href="{{ route('admin.guide.create') }}">
                            <i class="fa fa-cat"></i>
                            <span>Tạo mới</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>
