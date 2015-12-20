@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel fresh-color panel-info">
                <div class="panel-heading">{{ trans('manager.contacts.create.title') }}</div>
                <div class="panel-body">
                    @include('_errors')
                    {!! Form::model(new App\Contact, ['route' => ['manager.business.contact.store', $business]]) !!}
                    @include('manager.contacts._form',['submitLabel' => trans('manager.contacts.btn.store')])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
