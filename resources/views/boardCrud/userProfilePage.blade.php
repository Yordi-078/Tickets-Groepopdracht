@extends('layouts.app')
@section('second_script')
	<script src="{{ asset('js/editUser.js') }}" defer></script>
@endsection
@section('content')

@foreach($profileInfo as $test)
            
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="profile-card">
  <img class="profile-image" style="background-color:white" id="edit-uploaded-card-image">
  <h1>{{ $test["name"] }}</h1>
  <p class="profileTitle">{{ $test["user_role"] }}</p>
  <p>{{ $test["email"] }}</p>
  <a href="#"><i class="fa fa-dribbble"></i></a>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <a href="#"><i class="fa fa-linkedin"></i></a>
  <a href="#"><i class="fa fa-facebook"></i></a><br>
  <a class="profileBtn" href="{{ route('editUserProfile') }}">Edit</a>
</div>

@endforeach
@endsection