<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('app.nav.user.business.menu') }} <b
                class="caret"></b></a>
    <ul class="dropdown-menu">
        @if (!Auth::guest() && Auth::user()->isRoot())
            <li><a href="{{ route('root.dashboard') }}">{{ trans('app.root') }}</a></li>
            <li class="nav-divider"></li>
        @endif
        <li><a href="{{ route('manager.business.index') }}">{{ trans('app.nav.manager.business.list') }}</a>
        </li>
        <li>
            <a href="{{ route('manager.business.create') }}">{{ trans('app.nav.manager.business.register') }}</a>
        </li>
        <li class="nav-divider"></li>
        @if($business = Session::get('selected.business'))
            <li><a href="{{ route('user.businesses.home', $business->id) }}">{!! Icon::map_marker() !!}
                    &nbsp;{{ $business->name }}</a></li>
            <li class="nav-divider"></li>
        @endif
        <li><a href="{{ route('user.businesses.list') }}">{{ trans('app.nav.user.business.selector') }}</a></li>
        <li>
            <a href="{{ route('user.businesses.subscriptions') }}">{{ trans('app.nav.user.business.my_subscriptions') }}</a>
        </li>
        <li class="nav-divider"></li>
        <li><a href="{{ route('user.booking.list') }}">{{ trans('app.nav.user.business.my_appointments') }}</a></li>
        <li class="nav-divider"></li>
        <li><a href="{{ route('wizard.welcome') }}">{{ trans('app.nav.wizard') }}</a></li>
    </ul>
</li>