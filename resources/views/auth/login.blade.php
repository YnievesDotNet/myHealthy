@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('auth.login.title') }}</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>{{ trans('auth.login.alert.whoops') }}</strong> {{ trans('auth.login.alert.message') }}
                                <br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            {!! Button::success(trans('auth.btn.not_registered'))->block()->asLinkTo(url('/auth/register')) !!}
                            <p>&nbsp;</p>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('auth.login.email') }}</label>

                                <div class="col-md-8">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('auth.login.password') }}</label>

                                <div class="col-md-8">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember"> {{ trans('auth.login.remember_me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit"
                                            class="btn btn-primary">{{ trans('auth.login.login') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="login-footer">
                <a class="btn btn-link" href="{{ url('/password/email') }}">{{ trans('auth.login.forgot') }}</a>
            </div>
            {!! Button::success(trans('auth.btn.not_registered'))->withAttributes(['id' => 'btnNotRegistered', 'class' => 'hidden'])->block()->asLinkTo(url('/auth/register')) !!}
            @include('auth/social')
        </div>
    </div>
@endsection

@section('footer_scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $('#btnNotRegistered').hide();
            var timer;
            clearTimeout(timer);
            timer = setTimeout(function (event) {
                console.log('Search keypress');
                $('#btnNotRegistered').removeClass('hidden').show('slow');
            }, 10000);
        });
    </script>
@endsection