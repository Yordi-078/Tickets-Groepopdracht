@extends('layouts.app')

@section('content')
@if ($user->id == auth()->id())
    <h2> You cannot change you own user role</h2>
@else


<a href="{{ route('changeUserRoles') }}"> <-Return to change user roles page</a>
<h1>DESTROY CURRENT USER *THIS ACTION CANNOT BE UNDONE*</h1>

    <div class="">
        <a> name:{{ $user->name }} </a><br>
        <a> email:{{ $user->email }}</a><br>
        <a> role:{{ $user->user_role }}</a><br>
    </div>

    
<div class="">
    <div class="">
        <div class="">
            <div class="">
                <h2 class="">DELETE A USER</h2>
                <div class="">
                    <form method="POST" action="{{ url('destroyUser',$user->id)}} ">
                        @csrf
                        @method('POST')


                        <div class="">
                            <div class="">
                                <button type="submit" class="">DELETE USER</button>
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