@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 0px;">
            {!! Alert::info(trans('wizard.alert')) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! Panel::success()->withHeader(trans('wizard.business.header'))->withBody(
                Thumbnail::image(asset('img/wizard/panel-business.png'))->caption(trans('wizard.business.caption')).
                Button::success(trans('wizard.business.btn'))->large()->block()->asLinkTo(route('wizard.pricing'))
            ) !!}
        </div>
        <div class="col-md-6">
            {!! Panel::primary()->withHeader(trans('wizard.user.header'))->withBody(
            Thumbnail::image(asset('img/wizard/panel-user.png'))->caption(trans('wizard.user.caption')).
            Button::primary(trans('wizard.user.btn'))->large()->block()->asLinkTo(route('user.businesses.list'))
            ) !!}
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script language="JavaScript">
        $(".panel").addClass("fresh-color");
    </script>
@endsection