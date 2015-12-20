@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel fresh-color panel-info">
                <div class="panel-heading">{{ trans('user.contacts.create.title') }}</div>
                <div class="panel-body">
                    @include('_errors')
                    {!! Form::model($contact, ['method' => 'put', 'route' => ['user.business.contact.update', $business->id, $contact->id ]]) !!}
                    @include('user.contacts._form', ['submitLabel' => trans('user.contacts.btn.update')])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
