@can('admin')
    <li class="{{ $menu == 'admin' ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-th-large"></i>
            <span class="nav-label">@lang('sidemenu.administration')</span>
        </a>
        <ul class="nav nav-second-level">
            <li class="{{ $submenu == 'users' ? 'active' : '' }}">
                <a href="{{ action('UsersController@index') }}">@lang('sidemenu.users')</a>
            </li>

            <li class="{{ $submenu == 'payments' ? 'active' : '' }}">
                <a href="{{ '' }}">@lang('sidemenu.payments')</a>
            </li>
        </ul>
    </li>
@endcan

@can('sales')
    <li class="{{ $menu == 'sales' ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span class="nav-label">@lang('sidemenu.sales')</span>
        </a>
    </li>
@endcan
