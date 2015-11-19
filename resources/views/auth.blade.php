<!DOCTYPE html>
<html>
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
        <!-- CSS App -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/themes.css') }}">
    </head>
    <body class="flat-blue login-page">
        <div class="container">
            <div class="login-box">
                <div>
                    <div class="login-form row">
                        <div class="col-sm-12 text-center login-header">
                            <i class="login-logo fa fa-search fa-5x"></i>
                            <h4 class="login-title">{{trans('app.name')}}</h4>
                        </div>
                        <div class="col-sm-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            @include('flash::message')
        </div>


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
        <script type="text/javascript" src="{{ asset('js/findaproApp.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/chartjs/Chart.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/iCheck/icheck.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/matchHeight/jquery.matchHeight-min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/js/dataTables.bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/js/ace/ace.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/js/ace/mode-html.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/js/ace/theme-github.js') }}"></script>
        <!-- Javascript -->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @yield('footer_scripts')
    </body>
</html>