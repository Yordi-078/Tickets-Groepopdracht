@extends('layouts.app')

@section('content')
<div class="container">
    <button id="toggle-board"  onclick="myFunction()">block</button>
    <div class="flex-row" id="home-board-content-box" >
        @foreach($allBoard as $board)
            <div class="board flex-row">{{$board["name"]}}</div>
            <div class="board flex-row">{{$board["name"]}}</div>
            <div class="board flex-row">{{$board["name"]}}</div>
            <div class="board flex-row">{{$board["name"]}}</div>
            
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
