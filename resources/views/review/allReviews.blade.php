@extends('layouts.app')

@section('content')
    @foreach($reviews as $review)
    <div class="reviews">
        <p class="review"> {{$review["text"]}} </p>
    </div>
    @endforeach
@endsection