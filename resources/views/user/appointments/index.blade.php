@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['id' => 'postAppointmentStatus', 'method' => 'post', 'route' => ['api.booking.action']]) !!}
            @foreach ($appointments as $appointment)
                {!! Widget::AppointmentPanel(['appointment' => $appointment, 'user' => \Auth::user()]) !!}
            @endforeach
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('footer_scripts')
    @parent
    <script>
        $('.panel').addClass('fresh-color');
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
                        $('.panel').addClass('fresh-color');
                    });
                });
            }
            prepareEvents();
        });
    </script>
@endsection