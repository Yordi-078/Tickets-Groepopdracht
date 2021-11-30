@extends('layouts.app')

@section('content')
<div class="container">
    <button id="toggle-board" class="home-buttons" onclick="toggleBoard()"><i class="fas fa-bars"></i></button>
    <!-- this is what the user sees if user is admin or docent. 
    this wil be added to all the other code and wil not replace it -->
    <a href="{{ url('boardCrud/createCard', $board_id) }}" class="home-buttons">Add Card</a>
    @if (Auth::user()->user_role == 'teacher' || Auth::user()->user_role == 'admin' )
    <div class="home-buttons"><a class="Add-students-button" href="{{ route('addStudentsToBoard', $board_id) }}">
        {{ __('Add students') }}
    </a></div>
    @endif
    <div class="flex-row" id="home-board-content-box" >
        @foreach($cards as $card)
            <a href="#" class="board flex-row">{{$card["name"]}}</a>  
        @endforeach
    </div>

</div>
@endsection
