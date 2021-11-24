@extends('layouts.app')

@section('content')

<h1>Change User Roles Page</h1>


@foreach ($users as $user) 
    <div class="">
        <a> name:{{ $user->name }} </a><br>
        <a> email:{{ $user->email }}</a><br>
        <a> role:{{ $user->user_role }}</a><br>
        <a href="{{ route('changeUserForm', [$user->id]) }}"> Change this user role</a><br>
        <a>-------------------</a><br>
    </div>
@endforeach



@endsection