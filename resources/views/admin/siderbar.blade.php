@php
    $routeRoute = \Illuminate\Support\Facades\Request::route();
    $str = '';
    $route = '';
    if ($routeRoute){
        $route = $routeRoute->getName();
        $str = substr($route, 0, strpos($route, '.'));
    }
@endphp
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="height: 40px;">
        <div class="pull-left info">
            <strong>{{ (\Illuminate\Support\Facades\Auth::check()) ? \Illuminate\Support\Facades\Auth::user()->name : null }}</strong>
        </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">{{ __('label.master_data') }}</li>
        @can('view-other')
            <li class="{{ ($str == 'other') ? 'active' : '' }}">
                <a href="{{ route('other.list') }}">
                    <i class="fa fa-fw fa-cubes"></i>
                    <span>{{ __('label.other') }}</span>
                </a>
            </li>
        @endcan
        @can('data')
            <li class="{{ ($str == 'province') ? 'active' : '' }}">
                <a href="{{ route('province.index') }}">
                    <i class="fa fa-fw fa-cubes"></i>
                    <span>{{ __('label.province') }}</span>
                </a>
            </li>
        @endcan
        <li class="header">{{ __('label.main_navigation') }}</li>
        @can('dashboard')
            <li class="{{ ($str == 'dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ __('label.dashboard') }}</span>
                </a>
            </li>
        @endcan
        @can('view-user')
            <li class="{{ ($str == 'user') ? 'active' : '' }}">
                <a href="{{ route('user.list') }}">
                    <i class="fa fa-fw fa-group"></i>
                    <span>{{ __('label.user') }}</span>
                </a>
            </li>
        @endcan
        @can('view-car')
            <li class="{{ ($str == 'car') ? 'active' : '' }}">
                <a href="{{ route('car.list') }}">
                    <i class="fa fa-fw fa-bus"></i>
                    <span>{{ __('label.car') }}</span>
                </a>
            </li>
        @endcan
        @can('view-warehouse')
            <li class="{{ ($str == 'warehouse') ? 'active' : '' }}">
                <a href="{{ route('warehouse.list') }}">
                    <i class="fa fa-fw fa-institution"></i>
                    <span>{{ __('label.warehouse') }}</span>
                </a>
            </li>
        @endcan
        @can('view-driver')
            <li class="{{ ($str == 'driver') ? 'active' : '' }}">
                <a href="{{ route('driver.list') }}">
                    <i class="fa fa-fw fa-street-view"></i>
                    <span>{{ __('label.driver') }}</span>
                </a>
            </li>
        @endcan
        @can('view-company')
            <li class="{{ ($str == 'company') ? 'active' : '' }}">
                <a href="{{ route('company.list') }}">
                    <i class="fa fa-fw fa-building"></i>
                    <span>{{ __('label.company') }}</span>
                </a>
            </li>
        @endcan
        {{--@can('view-collection')--}}
            {{--<li class="{{ ($str == 'collection') ? 'active' : '' }}">--}}
                {{--<a href="{{ route('collection.list') }}">--}}
                    {{--<i class="fa fa-fw fa-street-view"></i>--}}
                    {{--<span>{{ __('label.collection') }}</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--@endcan--}}
        @can('view-customer')
            <li class="{{ ($str == 'customer') ? 'active' : '' }}">
                <a href="{{ route('customer.list') }}">
                    <i class="fa fa-heartbeat"></i>
                    <span>{{ __('label.customer') }}</span>
                </a>
            </li>
        @endcan
        {{--@can('view-dept')--}}
            {{--<li class="{{ ($str == 'dept') ? 'active' : '' }}">--}}
                {{--<a href="{{ route('dept.list') }}">--}}
                    {{--<i class="fa fa-euro"></i>--}}
                    {{--<span>{{ __('label.dept') }}</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--@endcan--}}
        @can('view-evaluate')
            <li class="{{ ($str == 'evaluate') ? 'active' : '' }}">
                <a href="{{ route('evaluate.list') }}">
                    <i class="fa fa-fw fa-star-half-o"></i>
                    <span>{{ __('label.evaluate') }}</span>
                </a>
            </li>
        @endcan
        @can('view-order')
            <li class="{{ ($str == 'order') ? 'active' : '' }}">
                <a href="{{ route('order.list.new') }}">
                    <i class="fa fa-fw fa-shopping-cart"></i>
                    <span>Đơn hàng </span>
                </a>
            </li>
        @endcan
        @can('view-delivery')
            <li class="{{ ($str == 'delivery') ? 'active' : '' }}">
                <a href="{{ route('delivery.list') }}">
                    <i class="fa fa-fw fa-truck"></i>
                    <span>{{ __('label.delivery') }}</span>
                </a>
            </li>
        @endcan
        <li class="header">{{ __('label.setting') }}</li>
        @can('view-permission')
            <li class="{{ ($str == 'role') ? 'active' : '' }}">
                <a href="{{ route('role.listRole') }}">
                    <i class="fa fa-dashboard"></i> <span>{{ __('label.permission') }}</span>
                </a>
            </li>
        @endcan
        @can('statistic')
            <li class="{{ ($str == 'statistic') ? 'active' : '' }}">
                <a href="{{ route('statistic.index') }}">
                    <i class="fa fa-bar-chart"></i> <span>{{ __('label.statistic') }}</span>
                </a>
            </li>
        @endcan
        @can('view-price')
            <li class="{{ ($str == 'price') ? 'active' : '' }}">
                <a href="{{ route('price.list') }}">
                    <i class="fa fa-money"></i> <span>{{ __('label.management_price') }}</span>
                </a>
            </li>
        @endcan
        @can('view-chat')
            <li class="{{ ($str == 'chat') ? 'active' : '' }}">
                <a href="{{ route('chat.list') }}">
                    <i class="fa fa-wechat "></i> <span>{{ __('label.chat') }}</span>
                </a>
            </li>
        @endcan
        @can('view-log')
            <li class="{{ ($str == 'log') ? 'active' : '' }}">
                <a href="{{ route('log.list') }}">
                    <i class="fa fa-tripadvisor"></i> <span>{{ __('label.log') }}</span>
                </a>
            </li>
        @endcan
        @can('map')
            <li class="treeview {{ ($str == 'map') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-fw fa-map-marker"></i> <span>{{ __('label.map') }}</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu {{ ($str == 'map') ? 'menu-open' : '' }}">
                    <li class="{{ ($route == 'map.street') ? 'active' : '' }}"><a href="{{ route('map.street') }}"><i class="fa fa-circle-o"></i> {{ __('label.map_street') }}</a></li>
                    <li class="{{ ($route == 'map.driver') ? 'active' : '' }}"><a href="{{ route('map.driver') }}"><i class="fa fa-circle-o"></i> {{ __('label.map_driver') }}</a></li>
                </ul>
            </li>
        @endcan
    </ul>
</section>
