<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="{{set_active(['admin.dashboard.*'])}}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>@lang('admin/global.sidebar_list.dashboard')</span>
                </a>
            </li>

            <li class="treeview {{set_active(['admin.tour.*'])}}">
                <a href="#">
                    <i class="glyphicon glyphicon-th-list"></i><span>Tour Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{set_active(['admin.tour.index'])}}">
                        <a href="{{ route('admin.tour.index') }}">
                            <i class="fa fa-mountains"></i>
                            <span>List</span>
                        </a>
                    </li>
                    <li class="{{set_active(['admin.tour.create'])}}">
                        <a href="{{ route('admin.tour.create') }}">
                            <i class="fa fa-cat"></i>
                            <span>Create</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{set_active(['admin.booking.*'])}}">
                <a href="{{ route('admin.booking.index') }}">
                    <i class="glyphicon glyphicon-check"></i>
                    <span>Manage booking</span>
                </a>
            </li>

            <li class="{{set_active(['admin.hotel.*'])}}">
                <a href="{{ route('admin.hotel.index') }}">
                    <i class="glyphicon glyphicon-home"></i>
                    <span>Manage hotel</span>
                </a>
            </li>


        </ul>

    </section>
    <!-- /.sidebar -->
</aside>
