@extends('layouts.app')

@section('content')
<div class="container">
    <button id="toggle-board" class="home-buttons" onclick="toggleBoard()">block</button>
    <!-- this is what the user sees if user is admin or docent. 
    this wil be added to all the other code and wil not replace it -->
    @if (Auth::user()->user_role == 'teacher' || Auth::user()->user_role == 'admin' )
    <div class="home-buttons"><a class=" create-board-button " href="{{ route('createBoard') }}">
        {{ __('create board') }}
    </a></div>
    @endif
    <div class="flex-row" id="home-board-content-box" >
        @foreach($allBoard as $board)
            <a href="{{ Route('oneBoard', $board['id']) }}" class="board flex-row">{{$board["name"]}}</a>  
        @endforeach
    </div>

</div>
@endsection