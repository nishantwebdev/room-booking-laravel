@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">



            <li class="{{ Request::segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>


            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                @can('role_access')
                <li class="{{ Request::segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ Request::segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('country_access')
            <!-- <li class="{{ Request::segment(2) == 'countries' ? 'active' : '' }}">
                <a href="{{ route('admin.countries.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.countries.title')</span>
                </a>
            </li> -->
            @endcan
            @can('category_create')
                <li class="{{ Request::segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.categories.title')
                            </span>
                        </a>
                    </li>
                @endcan

            @can('customer_access')
            <li class="{{ Request::segment(2) == 'customers' ? 'active' : '' }}">
                <a href="{{ route('admin.customers.index') }}">
                    <i class="fa fa-low-vision"></i>
                    <span class="title">@lang('quickadmin.customers.title')</span>
                </a>
            </li>
            @endcan

            @can('wing_access')
            <li class="{{ Request::segment(2) == 'wings' ? 'active' : '' }}">
                <a href="{{ route('admin.wings.index') }}">
                    <i class="fa fa-building-o"></i>
                    <span class="title">@lang('quickadmin.wings.title')</span>
                </a>
            </li>
            @endcan

            @can('building_access')
            <li class="{{ Request::segment(2) == 'buildings' ? 'active' : '' }}">
                <a href="{{ route('admin.buildings.index') }}">
                    <i class="fa fa-building"></i>
                    <span class="title">@lang('quickadmin.buildings.title')</span>
                </a>
            </li>
            @endcan

            @can('room_access')
            <li class="{{ Request::segment(2) == 'rooms' ? 'active' : '' }}">
                <a href="{{ route('admin.rooms.index') }}">
                    <i class="fa fa-bed"></i>
                    <span class="title">@lang('quickadmin.rooms.title')</span>
                </a>
            </li>
            @endcan

            @can('booking_access')
            <li class="{{ Request::segment(2) == 'bookings' ? 'active' : '' }}">
                <a href="{{ route('admin.bookings.index') }}">
                    <i class="fa fa-bell"></i>
                    <span class="title">@lang('quickadmin.bookings.title')</span>
                </a>
            </li>
            @endcan

            @can('find_room_access')
            <li class="{{ Request::segment(2) == 'find_rooms' ? 'active' : '' }}">
                <a href="{{ route('admin.find_rooms.index') }}">
                    <i class="fa fa-arrows"></i>
                    <span class="title">@lang('quickadmin.find-room.title')</span>
                </a>
            </li>
            @endcan


            <li class="{{ Request::segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li class="">
                <a href="{{URL::to('admin/token/edit')}}">
                    <i class="fa fa-key"></i>
                    <span class="title">Token Series</span>
                </a>
            </li>

            <li class="{{ Request::segment(1) == 'check-qr-scan' ? 'active' : '' }}">
                <a href="{{ URL::to('admin/check-qr-scan') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.check-qr-scan')</span>
                </a>
            </li>
            <li class="{{ Request::segment(1) == 'exit-out-scanning-data' ? 'active' : '' }}">
                <a href="{{ URL::to('admin/exit-out-scanning-data') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.check-qr-scan-out')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>

            <li>
                <a href="{{ route('app.logs') }}" target="_blank">
                    <i class="fa fa-info-circle"></i>
                    <span class="title">@lang('Error Logs')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
