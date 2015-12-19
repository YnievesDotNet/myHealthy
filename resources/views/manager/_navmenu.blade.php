@if(($business = Session::get('selected.business')) && Auth::user()->isOwner($business))
    <li id="navHome" class="hidden-sm hidden-xs"><a
                href="{{ route('manager.business.show', $business->id) }}">{!! Icon::home() !!} {{ trans('app.me') }} {{trans('app.name')}}</a>
    </li>
@endif
