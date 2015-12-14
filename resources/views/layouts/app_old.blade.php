<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <title>{{trans('app.name')}}</title>
    <!-- PACE -->
    <script type="text/javascript" src="{{ asset('bower_components/pace/pace.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bower_components/pace/themes/pace-theme-corner-indicator-orange.css') }}">

    <!-- Latest compiled and minified CSS -->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tooltipster/themes/tooltipster-timegrid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tooltipster/tooltipster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('css')

    <!-- Fonts -->
{{--    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> --}}

    @yield('headscripts')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>{!! Analytics::render() !!}
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @if (!Auth::guest() && Auth::user()->isRoot())
                        <li><a class="navbar-brand" href="{{ route('root.dashboard') }}">{{ trans('app.name') }}</a></li>
                    @else
                        <li><a class="navbar-brand" href="{{ url('/') }}">{{ trans('app.name') }}</a></li>
                    @endif

                    @if (!empty(Auth::user()))
                        @include('manager/_navmenu')
                    @endif
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @include('user/_navmenu')

                    @include('_navi18n')

                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">{{ trans('app.nav.login') }}</a></li>
                        <li><a href="{{ url('/auth/register') }}">{{ trans('app.nav.register') }}</a></li>
                    @else
                        <li id="navProfile" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ Gravatar::get(Auth::user()->email, ['size' => 24, 'secure' => true]) }}" class="img-circle"> {{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}">{{ trans('app.nav.logout') }}</a></li>
                                <li><a href="{!! env('DOCS_URL', 'http://docs.timegrid.io/') !!}{{Session::get('language')}}/">{{ trans('app.nav.manual') }}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @include('flash::message')
    </div>

    @yield('content')

    @include('partials._footer')

    <!-- Scripts -->
<!--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Latest compiled and minified JavaScript -->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.tooltipster.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn').tooltipster({animation: "grow", theme: 'tooltipster-timegrid'});
        });
    </script>
    @yield('footer_scripts')
</body>
</html>
