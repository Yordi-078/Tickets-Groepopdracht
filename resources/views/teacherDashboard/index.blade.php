@extends('layouts.app')
@section('content')

@foreach ($cards as $card)
    <a>{{ $card->name }}</a>
    <br>
    <a>{{ $card->updated_at }}</a>
@endforeach


@endsection