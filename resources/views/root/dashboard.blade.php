@extends('layouts.root')

@section('content')
    <h1>Registered Users</h1>
    {!! Table::withContents($users->toArray())->striped()->condensed()->hover() !!}
@endsection
