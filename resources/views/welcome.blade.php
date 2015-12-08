<!DOCTYPE html>
<html lang="en" ng-app="findaproApp">
    <head>
        <title>{{trans('app.name')}}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
        <!-- PACE -->
        <script type="text/javascript" src="{{ asset('bower_components/pace/pace.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('bower_components/pace/themes/pace-theme-corner-indicator-orange.css') }}">
        <!-- CSS Libs -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/fontawesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/animate.css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/iCheck/skins/flat/_all.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/DataTables/media/css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/ui-select/dist/select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/css/dataTables.bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/selectize.js/dist/css/selectize.bootstrap3.css') }}">
        <!-- CSS App -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/themes.css') }}">
    </head>
    <body class="flat-blue landing-page" ng-controller="welcomeController">
        <!-- Nav Bar -->
        <nav class="navbar navbar-inverse navbar-fixed-top  navbar-affix" role="navigation" data-spy="affix" data-offset-top="60">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <div class="icon fa fa-search"></div>
                        <div class="title">{{trans('app.name')}}</div>
                    </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">{{trans('app.homepage')}}</a></li>
                        <li><a href="#about">{{trans('app.about')}}</a></li>
                        <li><a href="#contact">{{trans('app.contact')}}</a></li>
                        @include('_navi18n')
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
        <div class="jumbotron app-header">
            <div class="container">
                <h2 class="text-center"><i class="app-logo fa fa-search fa-5x color-white"></i><div class="color-white">{{trans('app.name')}}</div></h2>
                <p class="text-center color-white app-description">{{trans('app.description')}}</p>
                <p class="text-center"><a class="btn btn-primary btn-lg app-btn" href="#" role="button">{{trans('app.more')}} »</a></p>
            </div>
        </div>
    <!-- Page Content -->
    <div class="container" style="margin-top: 10px;">
        <!-- Search Box -->
        <div class="row">
            <div class="col-sm-4">
                <div class="panel fresh-color panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('app.searchbox_title')}}</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="{{ url('/search')  }}">
                            <div class="form-group">
                                <label>{{trans('app.speciality')}}</label>
                                <select id="select-category" name="category" placeholder="{{trans('app.speciality')}}..."></select>
                            </div>
                            <div class="form-group">
                                <label>{{trans('app.country')}}</label>
                                <select id="select-country" name="country" placeholder="{{trans('app.country')}}..."></select>
                            </div>
                            <div class="form-group">
                                <label>{{trans('app.region')}}</label>
                                <select id="select-region" name="region" placeholder="{{trans('app.region')}}..."></select>
                            </div>
                            <div class="form-group">
                                <label>{{trans('app.location')}}</label>
                                <select id="select-location" name="location" placeholder="{{trans('app.location')}}..."></select>
                            </div>
                            <input class="btn btn-primary col-sm-12" type="submit" value="Buscar">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
            <header id="map" class="jumbotron hero-spacer col-sm-8" style="background: #22A7F0; color: snow; height: 420px;">
                <h1>
                    <i class="app-logo fa fa-search fa-2x color-white"></i>
                    {{ trans('welcome.jumbotron.title') }}
                </h1>
                <p class="hidden-xs" id="inspire">{{ trans('welcome.jumbotron.description') }}</p>
                <div class="row">
                    <span class="btn-group">
                        {!! Button::primary(trans('welcome.jumbotron.btn.begin'))->asLinkTo( url('auth/register') ) !!}
                        {!! Button::normal(trans('welcome.jumbotron.btn.login'))->asLinkTo( url('auth/login') ) !!}
                    </span>
                </div>
            </header>
        </div>
        <!-- Page Features -->
        <div class="row">

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail panel" id="optimize">
                    <img src="{{asset('img/jumbo/optimize.png')}}" alt="">
                    <div class="caption">
                        <h3>{{trans('welcome.feature.1.title')}}</h3>
                        <p>{{trans('welcome.feature.1.content')}}</p>
                        <p>
                            <a href="#" class="btn btn-primary">{{trans('welcome.feature.1.btn.action')}}</a>
                            <a href="#" class="btn btn-default">{{trans('welcome.feature.1.btn.info')}}</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail panel" id="contact">
                    <img src="{{asset('img/jumbo/contact.png')}}" alt="">
                    <div class="caption">
                        <h3>{{trans('welcome.feature.2.title')}}</h3>
                        <p>{{trans('welcome.feature.2.content')}}</p>
                        <p>
                            <a href="#" class="btn btn-primary">{{trans('welcome.feature.2.btn.action')}}</a>
                            <a href="#" class="btn btn-default">{{trans('welcome.feature.2.btn.info')}}</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail panel" id="do">
                    <img src="{{asset('img/jumbo/do.png')}}" alt="">
                    <div class="caption">
                        <h3>{{trans('welcome.feature.3.title')}}</h3>
                        <p>{{trans('welcome.feature.3.content')}}</p>
                        <p>
                            <a href="#" class="btn btn-primary">{{trans('welcome.feature.3.btn.action')}}</a>
                            <a href="#" class="btn btn-default">{{trans('welcome.feature.3.btn.info')}}</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail panel" id="love">
                    <img src="{{asset('img/jumbo/love.png')}}" alt="">
                    <div class="caption">
                        <h3>{{trans('welcome.feature.4.title')}}</h3>
                        <p>{{trans('welcome.feature.4.content')}}</p>
                        <p>
                            <a href="#" class="btn btn-primary">{{trans('welcome.feature.4.btn.action')}}</a>
                            <a href="#" class="btn btn-default">{{trans('welcome.feature.4.btn.info')}}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="copyright">
            <span class="label">Copyright &copy; YnievesDotNet 2007-<?php echo date('Y');?></span>
        </div>
    </div>
        <!-- /.row -->

        <!-- Javascript Libs -->
        <script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!--
          IE8 support, see AngularJS Internet Explorer Compatibility http://docs.angularjs.org/guide/ie
          For Firefox 3.6, you will also need to include jQuery and ECMAScript 5 shim
        -->
        <!--[if lt IE 9]>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.2.0/es5-shim.js"></script>
        <script>
            document.createElement('ui-select');
            document.createElement('ui-select-match');
            document.createElement('ui-select-choices');
        </script>
        <![endif]-->
        <script type="text/javascript" src="{{ asset('bower_components/angularjs/angular.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/angularjs/angular-resource.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/angularjs/angular-sanitize.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/ui-select/dist/select.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/selectize.js/dist/js/standalone/selectize.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/zelect/zelect.js') }}"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <!-- <script type="text/javascript" src="{{ asset('bower_components/gmaps/maps.api.false.es.js') }}"></script> -->
        <script type="text/javascript" src="{{ asset('bower_components/gmaps/gmaps.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/findaproApp.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/controllers/welcome.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/chartjs/Chart.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/iCheck/icheck.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/matchHeight/jquery.matchHeight-min.js') }}"></script>
    </body>
</html>
