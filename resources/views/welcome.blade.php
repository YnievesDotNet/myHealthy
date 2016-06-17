<!DOCTYPE html>
<html lang="en" ng-app="myHealthyApp">
<head>
    <title>{{ trans('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>
    <script type="text/javascript" src="{{ asset('bower_components/pace/pace.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bower_components/pace/themes/pace-theme-corner-indicator.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/animate.css/animate.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/iCheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/DataTables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/ui-select/dist/select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/selectize.js/dist/css/selectize.bootstrap3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themes.css') }}">
</head>
<body class="flat-blue landing-page" ng-controller="welcomeController">
<nav class="navbar navbar-inverse navbar-fixed-top  navbar-affix" role="navigation" data-spy="affix"
     data-offset-top="60">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('page.index') }}">
                <div class="icon fa fa-heartbeat"></div>
                <div class="title">{{trans('app.name')}}</div>
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
            {!! Menu::get('home_menu')->asUl(array('class' => 'nav navbar-nav')) !!}
            <ul class="nav navbar-nav">
                @include('partials._navi18n')
            </ul>
        </div>
    </div>
</nav>
<div class="jumbotron app-header">
    <div class="container">
        <h2 class="text-center"><i class="app-logo fa fa-heartbeat fa-5x color-white"></i></h2>
        <p class="text-center color-white app-description">{{trans('app.description')}}</p>
    </div>
</div>
<div class="container" style="margin-top: 10px;">
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
    @include('partials._footer')
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
<script type="text/javascript" src="{{ asset('js/myHealthyApp.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/controllers/welcome.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/chartjs/Chart.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/iCheck/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/matchHeight/jquery.matchHeight-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/mousescroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/smoothscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/jquery.prettyPhoto.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/jquery.isotope.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/jquery.inview.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/main.js') }}"></script>
</body>
</html>
