@extends('layouts.app')

@section('content')

<h2 id="reviewTitle" style="color:green;"> Wat vond u van de les? </h2>

<form id="reviewForm" class="make-card-form" method="POST" action="{{ url('storeReview', $board_id, $lessonCard_id) }}">

    @csrf
    <div id="smileys">
        <i id="bad" class="fa-regular fa-face-frown fa-6x"></i>
        <i id="neutral" class="fa-regular fa-face-meh fa-6x"></i>
        <i id="good" class="fa-regular fa-face-smile fa-6x"></i>
    </div>
        <div class="reviewForm">
            <label class="label" for="text" style="font-weight:600; font-size:20px; color:green;" id="reviewText">Review: </label>
            <input class="form-input-container input @error('text') is-danger @enderror" type="text" name="text" value="{{ old('text') }}">
            
            @error('text')
                <p class="help is-danger">{{ $errors->first('text') }}</p>
            @enderror
        </div>
       
        <button class="form-submit-button is-link" type="submit" style="margin-top: 105px;">Plaats</button> 
@endsection