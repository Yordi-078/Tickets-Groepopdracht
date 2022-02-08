@extends('layouts.app')

@section('content')
<br><br>

@foreach($profileInfo as $test)
            
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="profileCard">
  <img id="profileImg" src="">
  <h1>{{ $test["name"] }}</h1>
  <p class="profileTitle">{{ $test["user_role"] }}</p>
  <p>{{ $test["email"] }}</p>
  <a href="#"><i class="fa fa-dribbble"></i></a>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <a href="#"><i class="fa fa-linkedin"></i></a>
  <a href="#"><i class="fa fa-facebook"></i></a>
  <p><button class="profileBtn">Edit</button></p>
</div>

@endforeach
@endsection('content')