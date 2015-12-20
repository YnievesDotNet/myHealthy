@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel fresh-color panel-info">
                <div class="panel-heading">{{ trans('manager.contacts.create.title') }}</div>
                <div class="panel-body">
                    @include('_errors')
                    {!! Form::model($contact, ['method' => 'put', 'route' => ['manager.business.contact.update', $business->id, $contact->id ]]) !!}
                    @include('manager.contacts._form', ['submitLabel' => trans('manager.contacts.btn.update')])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
