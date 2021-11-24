@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->user_role == 'admin' || Auth::user()->user_role == 'teacher' )
                    <a class="dropdown-item" href="{{ route('createBoard') }}">
                        {{ __('create board') }}
                    </a><br>
                    <a class="dropdown-item" href="{{ route('changeUserRoles') }}">
                        {{ __('change user roles') }}
                    </a><br>

                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    <button id="toggle-board"  onclick="toggleBoard()">block</button>
    <div class="flex-row" id="home-board-content-box" >
        @foreach($allBoard as $board)
            <a href="{{ Route('oneBoard', $board['id']) }}" class="board flex-row">{{$board["name"]}}</a>    
            <a href="{{ Route('oneBoard', $board['id']) }}" class="board flex-row">{{$board["name"]}}</a>  
        @endforeach
    </div>
    
    <!-- this is what the user sees if user is admin or docent. 
    this wil be added to all the other code and wil not replace it -->
    @if (Auth::user()->user_role === 2 || Auth::user()->user_role === 1 )
    <a class="create-board-button" href="{{ route('createBoard') }}">
        {{ __('create board') }}
    </a>
    @endif
</div>
@endsection
