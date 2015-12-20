@extends('layouts/app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
@endsection

@section('content')
    {!! Form::open(array('route' => 'user.booking.store', 'class' => 'form')) !!}
    {!! Form::hidden('business_id', Session::get('selected.business')->id, array('required', 'id' => 'business_id') ) !!}

    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-sm-4">
                {!! Form::label( trans('user.appointments.form.date.label') ) !!}
                {!! Form::date('_date', null,
                    array('required',
                          'class'=>'form-control',
                          'id'=>'date',
                          'min'=> date('Y-m-d'),
                          'placeholder'=> trans('user.appointments.form.date.label') )) !!}
            </div>
            <div class="form-group col-sm-4">
                {!! Form::label( trans('user.appointments.form.time.label') ) !!}
                {!! Form::input('time', '_time', null,
                    array('required',
                          'class'=>'form-control',
                          'id'=>'time',
                          'step'=>'1800',
                          'placeholder'=> trans('user.appointments.form.time.label') )) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::label( trans('user.appointments.form.duration.label') ) !!}
                {!! Form::text('duration', 0,
                    array('required',
                          'readonly',
                          'id'=>'duration',
                          'class'=>'form-control',
                          'placeholder'=> trans('user.appointments.form.duration.label') )) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-11">
            {!! Form::select('service_id', ['0' => trans('user.appointments.form.msg.please_select_a_service')], '0', ['class'=>'', 'id' => 'service_id'] ) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-11">
            {!! Form::label( trans('user.appointments.form.comments.label') ) !!}
            {!! Form::text('comments', 'test',
                array('required',
                      'class'=>'form-control',
                      'placeholder'=> trans('user.appointments.form.comments.label') )) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-11">
            {!! Button::primary(trans('manager.contacts.btn.store'))->submit() !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script>
        $(function () {
            /* $( "#date" ).datepicker( { dateFormat: 'yy-mm-dd'} ); */
            $("#service_id").change(function () {
                var service_id = $(this).val();
                $.ajax({
                    url: '/api/services/duration/' + service_id,
                    type: 'GET',
                    dataType: 'text',
                    success: function (data) {
                        $('#duration').val(data);
                    },
                    fail: function (data) {
                        $('#duration').val(0);
                    }
                });
            });
            $.ajax({
                url: '/api/services/list/' + $('#business_id').val(),
                type: 'GET',
                dataType: 'json',
                success: function (json) {
                    $.each(json, function (i, value) {
                        $('#service_id').append($('<option>').text(value).attr('value', i));

                    });
                    $('#service_id').selectpicker();
                }
            });
        });
    </script>
@endsection