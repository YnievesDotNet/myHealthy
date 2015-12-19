<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{trans('app.name')}} | Root</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>
    <!-- PACE -->
    <script type="text/javascript" src="{{ asset('bower_components/pace/pace.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bower_components/pace/themes/pace-theme-corner-indicator-orange.css') }}">
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/animate.css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/iCheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/DataTables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css/dataTables.bootstrap.css') }}">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes.css') }}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="flat-blue">
<div class="app-container">
    <div class="row content-container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-expand-toggle">
                        <i class="fa fa-bars icon"></i>
                    </button>
                    <ol class="breadcrumb navbar-breadcrumb">
                        <li class="active">BreadCrumb</li>
                    </ol>
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="fa fa-th icon"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        {{--/ Language Switcher --}}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"
                               data-toggle="dropdown">{{ Config::get('languages')[App::getLocale()] }} <b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @foreach (Config::get('languages') as $lang => $language)
                                    @if ($lang != App::getLocale())
                                        <li>
                                            {!! link_to_route('lang.switch', $language, $lang) !!}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        {{-- Language Switcher /--}}
                        @if (Auth::guest())
                            <li><a href="{{ url('/auth/login') }}">{{ trans('app.nav.login') }}</a></li>
                            <li><a href="{{ url('/auth/register') }}">{{ trans('app.nav.register') }}</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">{{ Auth::user()->email }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/auth/logout') }}">{{ trans('app.nav.logout') }}</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="side-menu">
            <nav class="navbar navbar-default" role="navigation">
                <div class="side-menu-container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <div class="icon fa fa-search"></div>
                            <div class="title">{{trans('app.name')}}</div>
                        </a>
                        <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="index.html">
                                <span class="icon fa fa-search"></span><span class="title">Busqueda</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span class="icon fa fa-facebook"></span><span class="title">Facebook</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span class="icon fa fa-twitter"></span><span class="title">Twitter</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span class="icon fa fa-google-plus"></span><span class="title">GooglePlus</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span class="icon fa fa-youtube"></span><span class="title">Youtube</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span class="icon fa fa-instagram"></span><span class="title">Instagram</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="col-md-12">
                @include('flash::message')
            </div>
        </div>
        <div class="container-fluid">
            <div class="side-body padding-top">
                @yield('content')
            </div>
        </div>
    </div>
    @include('partials._footer')
            <!-- Javascript Libs -->
    <script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.tooltipster.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/chartjs/Chart.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/matchHeight/jquery.matchHeight-min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/js/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/js/ace/ace.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/js/ace/mode-html.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/js/ace/theme-github.js') }}"></script>
    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @yield('footer_scripts')
</div>
</body>
</html>
