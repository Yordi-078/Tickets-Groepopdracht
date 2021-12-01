@extends('layouts.app')

<form class="search" type="get" action="{{ route('searchAdminPage') }}">
    @csrf     
  <div class="input-group md-form form-sm form-1 pl-0">
    <div class="input-group-prepend">
      <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-danger" aria-hidden="true"></i></span>
    </div>
    <input class="form-control my-0 py-1" name="query" type="search" placeholder="Zoek" aria-label="Search">
  </div>
</form>

@section('content')

<a href="{{ route('home') }}">  <-Return to change user roles page </a>

<h1>Change User Roles Page</h1>

@foreach ($users as $user) 
    <div class="">
        <a> name:{{ $user->name }} </a><br>
        <a> email:{{ $user->email }}</a><br>
        <a> role:{{ $user->user_role }}</a><br>
        @if ($user->id == auth()->id())
            <a>You cannot change your own account</a><br>
            <a href="{{ route('destroyUserPage', [$user->id]) }}">Delete your own account!</a><br>
        @else
            <a href="{{ route('changeUserForm', [$user->id]) }}"> Change this user role</a><br>
            <a href="{{ route('destroyUserPage', [$user->id]) }}">Delete this user</a><br>
        @endif
        

        <a>-------------------</a><br>
    </div>
@endforeach



@endsection