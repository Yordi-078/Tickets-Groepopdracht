@extends('layouts.app')

@section('addStudent')
        <!-- this is what the user sees if user is admin or docent. 
        this wil be added to all the other code and wil not replace it -->
        @if (Auth::user()->user_role == 'teacher' || Auth::user()->user_role == 'admin' )
        <a class="dropdown-item" href="{{ route('addStudentsToBoard', $thisBoard['id']) }}">
            {{ __('Add students') }}
        </a>
        @endif
@endsection

@section('content')
<div class="question-board-container">
    <div class="board-header">
        <button id="toggle-board" class="home-buttons" onclick="toggleBoard()"><i class="fas fa-bars"></i></button>
        <a href="{{ url('boardCrud/createCard', $thisBoard['id']) }}" class="home-buttons">Add Card</a>

    </div>

    <div class="flex-row" id="board-question-content-box" >
        @foreach($cards as $card)
            <a href="#" class="board flex-row">{{$card["name"]}}</a>  
        @endforeach
    </div>

    
</div>
<div class="lesson-board-container">
    <div class="board-header">
        <a href="{{ url('boardCrud/createCard', $thisBoard['id']) }}" class="home-buttons">Add Card</a>
    </div>
    
    <div class="flex-row" id="board-lesson-content-box" >
        
            <a href="#" class="lesson-board">test les</a>  
        
    </div>
</div>
@endsection
