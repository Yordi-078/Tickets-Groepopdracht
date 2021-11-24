@extends('layouts.app')

@section('content')
@if ($user->id == auth()->id())
    <h2> You cannot change you own user role</h2>
@else


<a href="{{ route('changeUserRoles') }}"> <-Return to change user roles page</a>
<h1>Current User Data</h1>

    <div class="">
        <a> name:{{ $user->name }} </a><br>
        <a> email:{{ $user->email }}</a><br>
        <a> role:{{ $user->user_role }}</a><br>
    </div>

    
<div class="">
    <div class="">
        <div class="">
            <div class="">
                <h2 class="">Update a user</h2>
                <div class="">
                    <form method="POST" action="{{ url('updateUserRole',$user->id)}} ">
                        @csrf
                        @method('PUT')

                        <div class="">
                            <label for="name" class="">User Role</label>
                            <div class="">
                                
                                <select name='user_role' class="" required>
                                    <option selected disabled value="">Select a user role...</option>
                                    <option name="user_role" class="" value="{{ 1 }}" {{$user->user_role == 'student' ? 'selected' : ''}} autofocus>Student</option>
                                    <option name="user_role" class="" value="{{ 2 }}" {{$user->user_role == 'teacher' ? 'selected' : ''}} autofocus>Teacher</option>
                                    <option name="user_role" class="" value="{{ 3 }}" {{$user->user_role == 'admin'   ? 'selected' : ''}} autofocus>Admin</option>
                                </select>
                            </div>
                        </div>





                        <div class="">
                            <div class="">
                                <button type="submit" class="">UPDATE</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endif

@endsection