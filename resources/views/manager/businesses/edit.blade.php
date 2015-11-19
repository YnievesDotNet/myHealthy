@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('manager.businesses.edit.title') }}</div>

            <div class="panel-body">
                @include('_errors')

                {!! Form::model($business, ['method' => 'put', 'route' => ['manager.business.update', $business->id], 'id' => 'registration', 'data-toggle' => 'validator']) !!}
                @include('manager.businesses._form', ['submitLabel' => trans('manager.businesses.btn.update')])
                {!! Form::close() !!}
            </div>

            <div class="panel-footer">

            </div>
        </div>
    </div>
</div>
@endsection


