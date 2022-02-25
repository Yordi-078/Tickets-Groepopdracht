@extends('layouts.app')
@section('content')
@if ($user->id == auth()->id())
    <h2> You cannot change you own user role</h2>
@else


<a class="change-user-back-button" href="{{ route('changeUserRoles') }}"> <-Return to change user roles page</a>

<div class="change-user-role-form">
<h1 class="change-user-role-data-header">Current User Data</h1>
<h1 class="change-user-role-form-heade">Update this user</h1>

    <div class="change-user-role-user-data">
        <a> name:{{ $user->name }} </a><br>
        <a> email:{{$user->email }}</a><br>
        <a> role:{{$user->userRole->role }}</a><br>
    </div>

    
<div class="">
    
    <div class="change-user-role-user-form">
        <form method="POST" action="{{ url('updateUserRole',$user->id)}} ">
            @csrf
            @method('POST')
                <label for="name" class="">User Role:</label>
                <select name='user_role_id' class="" required>
                    <option selected disabled value="">Select a user role...</option>
                    <option name="user_role_id" class="" value="{{ 1 }}" {{$user->user_role_id == 1 ? 'selected' : ''}} autofocus>Student</option>
                    <option name="user_role_id" class="" value="{{ 2 }}" {{$user->user_role_id == 2 ? 'selected' : ''}} autofocus>Teacher</option>
                    <option name="user_role_id" class="" value="{{ 3 }}" {{$user->user_role_id == 3 ? 'selected' : ''}} autofocus>Admin</option>
                </select>
                <div>
                    <button type="submit" class="change-user-role-submit-button">UPDATE</button>
                </div>
        </form>
    </div>
</div>
</div>

@endif

@endsection