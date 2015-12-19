@extends('layouts.app')

@section('content')
    @foreach ($results as $category => $items)
        @include('manager.search._'.$category, ['items' => $items])
    @endforeach
@endsection
