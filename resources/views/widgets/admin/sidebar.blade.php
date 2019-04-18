<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="active">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>@lang('admin/global.sidebar_list.dashboard')</span>
                </a>
            </li>
            <li class="{{set_active(['admin.tour.*'])}}">
                <a href="{{ route('admin.tour.index') }}">
                    <i class="fa fa-mountains"></i>
                    <span>List tour</span>
                </a>
            </li>

            <li class="{{set_active(['admin.booking.*'])}}">
                <a href="{{ route('admin.booking.index') }}">
                    <i class="fa fa-cat"></i>
                    <span>List booking</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
