@extends('layouts/app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel fresh-color panel-info">
                <div class="panel-heading">{{ trans('user.businesses.suscriptions.title') }}</div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->nin }}</td>
                                <td>{{ $contact->firstname }}</td>
                                <td>{{ $contact->lastname }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    @if($contact->businesses()->count())
                                        @foreach ($contact->businesses as $business)
                                            {!! Button::normal($business->slug)->asLinkTo( route('user.business.contact.show', [$business, $contact])) !!}
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>
@endsection