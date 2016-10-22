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

            <li class="{{ $submenu == 'menus' ? 'active' : '' }}">
                <a href="{{ action('MenusController@index') }}">@lang('sidemenu.menus')</a>
            </li>

            <li class="{{ $submenu == 'payments' ? 'active' : '' }}">
                <a href="{{ action('PaymentsController@index') }}">@lang('sidemenu.payments')</a>
            </li>
        </ul>
    </li>
@endcan

@can('sales')
    <!-- <li class="{{ $menu == 'sales' ? 'active' : '' }}">
        <a href="{{ '' }}">
            <i class="fa fa-bar-chart-o"></i>
            <span class="nav-label">@lang('sidemenu.sales')</span>
        </a>
    </li> -->
@endcan

@can('orders')
    <li class="{{ $menu == 'orders' ? 'active' : '' }}">
        <a href="{{ '' }}">
            <i class="fa fa-cutlery"></i>
            <span class="nav-label">@lang('sidemenu.orders')</span>
        </a>
    </li>
@endcan

@can('checkout')
    <li class="{{ $menu == 'checkout' ? 'active' : '' }}">
        <a href="{{ '' }}">
            <i class="fa fa-usd"></i>
            <span class="nav-label">@lang('sidemenu.checkout')</span>
        </a>
    </li>
@endcan
