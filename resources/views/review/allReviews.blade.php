@extends('layouts.app')

@section('content')

<div class="main-section">
    <div class="hedding-title"><h1>Les Reviews</h1></div>
        <div class="rating-part">
        <div class="average-rating">
    </div>
    
<div style="clear: both;"></div>
<div class="reviews"><h1>Reviews</h1></div>
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
<i id="neutral" class="fa-regular fa-face-meh fa-2x"></i>
<p>{{$review->text}}</p>

</div>

<div style="clear: both;"></div>
</div>

@endforeach
@endsection