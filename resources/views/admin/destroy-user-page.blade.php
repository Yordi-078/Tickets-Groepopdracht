@extends('layouts.app')
@section('content')


<a href="{{ route('changeUserRoles') }}"> <-Return to change user roles page</a>


destroy
@if ($user->id == auth()->id())
    <h1>DESTROY YOUR OWN ACCOUNT *THIS ACTION CANNOT BE UNDONE*</h1>
@else
    <h1>DESTROY CURRENT USER *THIS ACTION CANNOT BE UNDONE*</h1>
@endif

    <div class="">
        <a> name:{{ $user->name }} </a><br>
        <a> email:{{ $user->email }}</a><br>
        <a> role:{{ $user->user_role }}</a><br>
    </div>

    
<div class="">
    <div class="">
        <div class="">
            <div class="">
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



@endsection