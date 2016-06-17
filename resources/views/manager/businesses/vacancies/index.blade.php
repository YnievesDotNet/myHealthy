@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/bootstrap-calendar/css/calendar.min.css') }}">
    {{--<link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.css') }}">--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel fresh-color panel-info">
                <div class="panel-heading">{{ trans('manager.vacancies.edit.title') }}</div>
                <div class="panel-body">
                    @include('_errors')
                    {!! Form::open(['method' => 'post', 'route' => ['manager.business.vacancy.store', $business->id]]) !!}
                    <div class="col-md-3">
                        <div class="well">
                            <p><b>Agregar disponibilidad</b></p>

                            <p>TODO Formulario</p>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="col-md-9">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    {!! $calendar->jsScript() !!}
    {!! $calendar->script() !!}
@endsection