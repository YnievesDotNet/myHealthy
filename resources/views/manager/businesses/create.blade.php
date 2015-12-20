@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel fresh-color panel-info">
                <div class="panel-heading">{{ trans('manager.businesses.create.title') }}</div>
                <div class="panel-body">
                    @include('_errors')
                    {!! Form::model(new App\Business, ['route' => ['manager.business.store'], 'id' => 'registration', 'data-toggle' => 'validator']) !!}
                    {!! Form::hidden('plan', $plan) !!}
                    @include('manager.businesses._form', ['submitLabel' => trans('manager.businesses.btn.store')])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection