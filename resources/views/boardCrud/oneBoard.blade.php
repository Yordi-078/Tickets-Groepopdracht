@extends('layouts.app')

<?php 

use Illuminate\support\facades\Auth;
$user_id = Auth::user()->id;

?>

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
            
            <a href="#" class="cards flex-row">
                <button class="card-popup-button" onclick="showPopup('myModal{{$card['id']}}')">
                    <i class="far fa-eye"></i>
                </button>
                {{$card["name"]}}
            </a> 

            @if ($user_id == $card["user_id"])
            <!-- The Modal -->
            <div id="myModal{{$card['id']}}" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  
                  <form action="{{ url('updateCard', [$card['id'], $card['board_id']]) }}" method="POST">
                      
                      @csrf
                        <div id="general">
                            <input type="text" name ="name" value="{{$card['name']}}" required>
                            <input type="text" name="description" value="{{$card['description']}}" required>
                        </div>
                        <div id="imageUploader">
                            <input type="file">
                        </div>
                        <select name="status">
                            <option value="{{$card['in_progress']}}">in progress</option>
                            <option value="{{$card['finished']}}">finished</option>
                        </select>
                        <button type="submit">Submit</button>
                  </form>
                </div>
  
            </div>
            
            @else
            <!-- The Modal -->
            <div id="myModal{{$card['id']}}" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  
                  <form>
                        <div id="general">
                            <input type="text" value="{{$card['name']}}" required readonly>
                            <input type="text" value="{{$card['description']}}" required readonly>
                        </div>
                        <div id="imageUploader">
                            <input type="file" readonly>
                        </div>
                        <select name="status">
                            <option value="in_progress">in progress</option>
                            <option value="finished">finished</option>
                        </select>
                        <input type="button" value="{{$card['helper']}}" readonly>
                        <p>{{$card['created_at']}}</p>
                  </form>
                </div>
  
            </div>

            @endif 
            @endforeach
    </div>

    
</div>
<div class="lesson-board-container">
    <div class="board-header">
        <a href="{{ url('boardCrud/createLessCard', $thisBoard['id']) }}" class="home-buttons">Add Card</a>
    </div>
    
    <div class="flex-row" id="board-lesson-content-box" >
        
        @foreach($lessonCards as $lessonCard)
        <a href="#" class="toggle cards flex-row">{{$lessonCard["name"]}}<button class="card-popup-button" onclick="showPopup('myModalLesson{{$lessonCard['id']}}')"><i class="far fa-eye"></i></button></a> 
        
        <!-- The Modal -->
        <div id="myModalLesson{{$lessonCard['id']}}" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
              <span class="close">&times;</span>
              <form>
                <a href="{{ url('storeLessonUpVote', [$lessonCard['id'], $thisBoard['id']]) }}" class="home-buttons">Upvote</a>
              </form>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection

