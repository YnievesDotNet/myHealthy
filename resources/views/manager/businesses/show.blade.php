@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    @parent
    <style type="text/css">
        .bizurl {
            font-family: monospace;
            background: #ECECEC;
            padding: 10px 8px;
            margin: 0px 0px 20px 0px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel fresh-color panel-info" id="dashboard">
                <div class="panel-heading">
        <span class="btn-group">
            {!! Button::withIcon(Icon::cog())->normal()->withAttributes(['id' => 'btnPreferences', 'title' => trans('manager.business.btn.tooltip.preferences')])->asLinkTo( route('manager.business.preferences', $business) ) !!}
            {!! Button::withIcon(Icon::edit())->primary()->withAttributes(['id' => 'btnEdit', 'title' => trans('manager.business.btn.tooltip.edit')])->asLinkTo( route('manager.business.edit', $business) ) !!}
        </span>
        <span class="btn-group">
            {!! Button::withIcon(Icon::tag())->normal()->withAttributes(['id' => 'btnServices', 'title' => trans('manager.business.btn.tooltip.services')])->asLinkTo( route('manager.business.service.index', $business) ) !!}
            {!! Button::withIcon(Icon::time())->normal()->withAttributes(['id' => 'btnVacancies', 'title' => trans('manager.business.btn.tooltip.vacancies')])->asLinkTo( route('manager.business.vacancy.index', $business) ) !!}
            {!! Button::withIcon(Icon::calendar())->withAttributes(['id' => 'btnSchedule', 'title' => trans('manager.business.btn.tooltip.schedule')])->normal()->asLinkTo( route('manager.business.schedule.index', $business) ) !!}
        </span>
        <span class="btn-group">
            {!! Button::withIcon(Icon::user())->withAttributes(['id' => 'btnContacts', 'title' => trans('manager.business.btn.tooltip.contacts')])->normal()->asLinkTo( route('manager.business.contact.index', $business) ) !!}
        </span>
                </div>
                <div class="panel-body">
                    @if ($business->services()->count() == 0)
                        <div class="row">
                            <div class="col-md-12">
                                {!! Alert::warning(Button::withIcon(Icon::tag())->warning()->asLinkTo( route('manager.business.service.create', $business)) . '&nbsp;' . trans('manager.businesses.dashboard.alert.no_services_set')) !!}
                            </div>
                        </div>
                    @endif
                    @if ($business->vacancies()->future()->count() == 0)
                        <div class="row">
                            <div class="col-md-12">
                                {!! Alert::warning(Button::withIcon(Icon::time())->warning()->asLinkTo( route('manager.business.vacancy.create', $business)) . '&nbsp;' . trans('manager.businesses.dashboard.alert.no_vacancies_set')) !!}
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <blockquote><p>{{ str_limit($business->description, 30) }}</div>
                        <div class="col-md-4">
                            <blockquote><p>{!! Icon::globe() !!}&nbsp;{{ $business->timezone }}</p></blockquote>
                        </div>
                        <div class="col-md-4">
                            <div class="bizurl">{{ URL::to($business->slug) }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="card blue summary-inline">
                                <div class="card-body">
                                    <i class="icon fa fa-calendar fa-4x"></i>

                                    <div class="content">
                                        <div class="title">
                                            {{ $business->bookings()->ofDate(Carbon::now())->active()->get()->count() }}
                                        </div>
                                        <div class="sub-title">{{ trans('manager.businesses.dashboard.panel.title_appointments_active') }}
                                            - {{ trans('manager.businesses.dashboard.panel.title_appointments_today') }}</div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="card red summary-inline">
                                <div class="card-body">
                                    <i class="icon fa fa-calendar-o fa-4x"></i>

                                    <div class="content">
                                        <div class="title">
                                            {{ $business->bookings()->ofDate(Carbon::now())->annulated()->get()->count() }}
                                        </div>
                                        <div class="sub-title">{{ trans('manager.businesses.dashboard.panel.title_appointments_annulated') }}
                                            - {{ trans('manager.businesses.dashboard.panel.title_appointments_today') }}</div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="card green summary-inline">
                                <div class="card-body">
                                    <i class="icon fa fa-calendar fa-4x"></i>

                                    <div class="content">
                                        <div class="title">
                                            {{ $business->bookings()->ofDate(Carbon::tomorrow())->active()->get()->count() }}
                                        </div>
                                        <div class="sub-title">{{ trans('manager.businesses.dashboard.panel.title_appointments_active') }}
                                            - {{ trans('manager.businesses.dashboard.panel.title_appointments_tomorrow') }}
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="card yellow summary-inline">
                                <div class="card-body">
                                    <i class="icon fa fa-tags fa-4x"></i>

                                    <div class="content">
                                        <div class="title">{{ $business->bookings()->active()->get()->count() }}</div>
                                        <div class="sub-title">{{ trans('manager.businesses.dashboard.panel.title_appointments_active') }}
                                            - {{ trans('manager.businesses.dashboard.panel.title_appointments_total') }}</div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="card green summary-inline">
                                <div class="card-body">
                                    <i class="icon fa fa-archive fa-4x"></i>

                                    <div class="content">
                                        <div class="title">{{ $business->bookings()->served()->get()->count() }}</div>
                                        <div class="sub-title">{{ trans('manager.businesses.dashboard.panel.title_appointments_served') }}
                                            - {{ trans('manager.businesses.dashboard.panel.title_appointments_total') }}</div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="card yellow summary-inline">
                                <div class="card-body">
                                    <i class="icon fa fa-tags fa-4x"></i>

                                    <div class="content">
                                        <div class="title">{{ $business->bookings()->get()->count() }}</div>
                                        <div class="sub-title">{{ trans('manager.businesses.dashboard.panel.title_appointments_total') }}
                                            - {{ trans('manager.businesses.dashboard.panel.title_appointments_total') }}</div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="card red summary-inline">
                                <div class="card-body">
                                    <i class="icon fa fa-user fa-4x"></i>

                                    <div class="content">
                                        <div class="title">{{ $business->contacts()->count() }}</div>
                                        <div class="sub-title">{{ trans('manager.businesses.dashboard.panel.title_contacts_registered') }}
                                            - {{ trans('manager.businesses.dashboard.panel.title_contacts_total') }}</div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="card blue summary-inline">
                                <div class="card-body">
                                    <i class="icon fa fa-users fa-4x"></i>

                                    <div class="content">
                                        <div class="title">{{ $business->contacts()->whereNotNull('user_id')->count() }}</div>
                                        <div class="sub-title">{{ trans('manager.businesses.dashboard.panel.title_contacts_active') }}
                                            - {{ trans('manager.businesses.dashboard.panel.title_contacts_total') }}</div>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('manager.businesses._notifications', ['notifications' => $notifications ])
                        </div>
                    </div>
                </div>
                <div class="panel-footer">{{ $business->name }}</div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    @parent
    <script src="{{ asset('js/jquery.bootstrap.newsbox.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tour.min.js') }}"></script>
    <script type="text/javascript">
        (function () {

            @if ($business->vacancies()->future()->count() == 0)
                $('#btnVacancies').tooltipster({
                animation: 'fade',
                delay: 200,
                theme: 'tooltipster-timegrid',
                touchDevices: true,
                content: $('<strong>{!! trans('manager.business.hint.out_of_vacancies') !!}</strong>')
            }).tooltipster('show');
            @endif

             // Instance the tour
            var tourDashboard = new Tour({
                duration: 10000,
                delay: 100,
                template: "@include('tour._template')",
                onEnd: function (tourDashboard) {

                    $('#btnVacancies').tooltipster({
                        animation: 'fade',
                        delay: 200,
                        theme: 'tooltipster-timegrid',
                        touchDevices: true,
                        content: $('<strong>{!! trans('manager.business.hint.set_services') !!}</strong>')
                    }).tooltipster('show');

                },
                steps: [
                    {
                        element: "#general",
                        title: "{{trans('tour.dashboard.panel.title')}}",
                        content: "{{trans('tour.dashboard.panel.content')}}",
                        orphan: true,
                        duration: 18000
                    },
                    {
                        element: "#btnEdit",
                        title: "{{trans('tour.dashboard.edit.title')}}",
                        content: "{{trans('tour.dashboard.edit.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#btnServices",
                        title: "{{trans('tour.dashboard.services.title')}}",
                        content: "{{trans('tour.dashboard.services.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#btnVacancies",
                        title: "{{trans('tour.dashboard.vacancies.title')}}",
                        content: "{{trans('tour.dashboard.vacancies.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#btnSchedule",
                        title: "{{trans('tour.dashboard.schedule.title')}}",
                        content: "{{trans('tour.dashboard.schedule.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#btnContacts",
                        title: "{{trans('tour.dashboard.contacts.title')}}",
                        content: "{{trans('tour.dashboard.contacts.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#indicator1",
                        title: "{{trans('tour.dashboard.indicator1.title')}}",
                        content: "{{trans('tour.dashboard.indicator1.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#indicator2",
                        title: "{{trans('tour.dashboard.indicator2.title')}}",
                        content: "{{trans('tour.dashboard.indicator2.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#indicator3",
                        title: "{{trans('tour.dashboard.indicator3.title')}}",
                        content: "{{trans('tour.dashboard.indicator3.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#indicator4",
                        title: "{{trans('tour.dashboard.indicator4.title')}}",
                        content: "{{trans('tour.dashboard.indicator4.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#indicator5",
                        title: "{{trans('tour.dashboard.indicator5.title')}}",
                        content: "{{trans('tour.dashboard.indicator5.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#indicator6",
                        title: "{{trans('tour.dashboard.indicator6.title')}}",
                        content: "{{trans('tour.dashboard.indicator6.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#indicator7",
                        title: "{{trans('tour.dashboard.indicator7.title')}}",
                        content: "{{trans('tour.dashboard.indicator7.content')}}",
                        placement: "top"
                    },
                    {
                        element: "#indicator8",
                        title: "{{trans('tour.dashboard.indicator8.title')}}",
                        content: "{{trans('tour.dashboard.indicator8.content')}}",
                        placement: "top"
                    },
                    {
                        element: "#indicator9",
                        title: "{{trans('tour.dashboard.indicator9.title')}}",
                        content: "{{trans('tour.dashboard.indicator9.content')}}",
                        placement: "top"
                    },
                    {
                        element: "#search",
                        title: "{{trans('tour.dashboard.search.title')}}",
                        content: "{{trans('tour.dashboard.search.content')}}",
                        placement: "bottom",
                        duration: 12000
                    },
                    {
                        element: "#navHome",
                        title: "{{trans('tour.dashboard.home.title')}}",
                        content: "{{trans('tour.dashboard.home.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#navLang",
                        title: "{{trans('tour.dashboard.lang.title')}}",
                        content: "{{trans('tour.dashboard.lang.content')}}",
                        placement: "bottom",
                        duration: 12000
                    },
                    {
                        element: "#navProfile",
                        title: "{{trans('tour.dashboard.profile.title')}}",
                        content: "{{trans('tour.dashboard.profile.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#btnDelete",
                        title: "{{trans('tour.dashboard.delete.title')}}",
                        content: "{{trans('tour.dashboard.delete.content')}}",
                        placement: "bottom"
                    },
                    {
                        element: "#enjoy",
                        title: "{{trans('tour.dashboard.enjoy.title')}}",
                        content: "{{trans('tour.dashboard.enjoy.content')}}",
                        orphan: true,
                        duration: 20000,
                    },
                ]
            });

// Initialize the tour
            tourDashboard.init();

// Start the tour
            tourDashboard.start();

            $(".demo").bootstrapNews({
                newsPerPage: 4,
                navigation: true,
                autoplay: true,
                direction: 'up', // up or down
                animationSpeed: 'normal',
                newsTickerInterval: 4000, //4 secs
                pauseOnHover: true,
                onStop: null,
                onPause: null,
                onReset: null,
                onPrev: null,
                onNext: null,
                onToDo: null
            });

        })();
    </script>
@endsection