@extends('layouts.app')

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