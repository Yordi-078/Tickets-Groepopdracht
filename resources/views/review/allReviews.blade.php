@extends('layouts.app')

@section('content')

<div class="main-section">
    <div class="hedding-title"><h1>Reviews</h1></div>
        <div class="rating-part">
        <div class="average-rating">
    </div>
   
<div style="clear: both;"></div>
<div class="reviews"><h1>{{ $lessonsCard->name }}</h1></div>
@foreach($reviews as $review)

<div class="comment-part">
    <div class="user-img-part">
        <div class="user-img">
            <img src="">
</div>

<div class="user-text">
    <p>User</p>
</div>

<div style="clear: both;"></div>
</div>

<div class="comment">
    @if($review->rating == 1)
    <i id="sad" style="color: red;" class="fa-regular fa-face-frown fa-2x"></i>
    
    @elseif($review->rating == 2)
    <i id="neutral" style="color: yellow;" class="fa-regular fa-face-meh fa-2x"></i>
    
    @elseif($review->rating == 3)
    <i id="happy" style="color: green;" class="fa-regular fa-face-smile fa-2x"></i>
    @endif
    <p>{{$review->text}}</p>
</div>

<div style="clear: both;"></div>
</div>

@endforeach
@endsection