@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if(\Auth::user()->isOwner($business))
                    {!! Icon::star() !!} {!! link_to(route('manager.business.show', $business), $business->name) !!}
                @else
                    {{ $business->name }}
                @endif
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    {{--{{ trans_choice('user.business.suscriptions_count', $business->suscriptionsCount) }}--}}
                </li>
                <li class="list-group-item">
                    {!! $business->getPresenter()->getIndustryIcon() !!}
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="media">
                                <div class="media-left media-top hidden-xs hidden-sm">
                                    <a href="#">{!! $business->getPresenter()->getFacebookImg('normal') !!}</a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $business->name }}</h4>
                                    <blockquote>{!! nl2br(e($business->description)) !!}</blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @if ($business->phone || $business->postal_address)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">
                                @if ($business->pref('show_phone') && $business->phone)
                                    {!! Icon::phone() !!}&nbsp;{{ $business->phone }}
                                @endif
                            </div>
                            <div class="col-md-8">
                                @if ($business->pref('show_postal_address') && $business->postal_address)
                                    {!! Icon::home() !!}&nbsp;{{ $business->postal_address }}
                                @endif
                            </div>
                        </div>
                    </li>
                @endif
                @if ($appointment = \Auth::user()->appointments()->where('business_id', $business->id)->oldest()->active()->future()->first())
                    {!! Form::open(['id' => 'postAppointmentStatus', 'method' => 'post', 'route' => ['api.booking.action']]) !!}
                    <li class="list-group-item" title="{{$business->timezone}}">
                        {!! Widget::AppointmentPanel(['appointment' => $appointment, 'user' => \Auth::user()]) !!}
                    </li>
                    {!! Form::close() !!}
                @endif
                @if ($business->pref('show_map') && $business->postal_address)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                {!! $business->getPresenter()->getStaticMap(11) !!}
                            </div>
                        </div>
                    </li>
                @endif
                @if (!($appointment and $appointment->isActive()))
                    <li class="list-group-item">
                        @if (\Auth::user()->suscribedTo($business) === null)
                            {!! Button::large()->primary(trans('user.business.btn.suscribe'))->asLinkTo(route('user.business.contact.create', $business))->withIcon(Icon::star())->block() !!}
                        @else
                            {!! Button::large()->success(trans('user.appointments.btn.book'))->asLinkTo(route('user.booking.book', $business))->withIcon(Icon::calendar())->block() !!}
                        @endif
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endsection

@section('footer_scripts')
    @parent
    <script>
        $(document).ready(function () {
            function prepareEvents() {
                console.log('prepareEvents()');
                var form = $('#postAppointmentStatus');
                var button = $('.action');
                var buttons = $('.actiongroup');
                var token = $('input[name=_token]');
                button.click(function (event) {
                    event.preventDefault();
                    var business = $(this).data('business');
                    var appointment = $(this).data('appointment');
                    var action = $(this).data('action');
                    var code = $(this).data('code');
                    var panel = $('#' + code);
                    $(this).parent().hide();
                    $.ajax({
                        url: form.attr('action'),
                        method: 'post',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': token.val()
                        },
                        data: {business: business, appointment: appointment, action: action, widget: 'panel'}
                    }).done(function (data) {
                        console.log('AJAX Done');
                        $('#' + code).replaceWith(data.html);
                    }).fail(function (data) {
                        console.log('AJAX Fail');
                    }).always(function (data) {
                        $(this).parent().show();
                        prepareEvents();
                        console.log('AJAX Finish');
                        console.log(data);
                    });
                });
            }
            prepareEvents();
        });
    </script>
@endsection