@extends('layouts.app')

<?php 

use Illuminate\support\facades\Auth;
$user_id = Auth::user()->id;

?>

@section('content')
<div class="board-page-header">
    <!-- this is what the user sees if user is admin or docent. 
    this wil be added to all the other code and wil not replace it -->
    @if (Auth::user()->user_role == 'teacher' || Auth::user()->user_role == 'admin' )
    <a id="add-student-button" class="dropdown-item" href="{{ route('addStudentsToBoard', $thisBoard['id']) }}">
        {{ __('Add students') }}
    </a>
    @endif
</div>
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
                  <span id="close-popup" class="close">&times;</span>
                  
                  <form  id="card-info-popup" action="{{ url('updateCard', [$card['id'], $card['board_id']]) }}" method="POST">
                      
                      @csrf
                      <div id="general" class="card-info-border">
                            <span><i class="fas fa-align-left"></i></span>
                            <textarea type="text" id="title" name="name" maxlength="300" required>{{$card['name']}}</textarea>
                            <span>descrition: </span>
                            <textarea type="text" id="description" name="description" maxlength="665" required>{{$card['description']}}</textarea>
                        </div>

                        <div id="image-uploader" class="card-info-border">
                            <input type="file">
                        </div>
                        <div id="progress-info" class="card-info-border">
                            <p>{{$card['created_at']}}</p>
                            <select name="status">
                                <option value="{{$card['in_progress']}}">in progress</option>
                                <option value="{{$card['finished']}}">finished</option>
                            </select>
                        </div>
                        <div id="helper-box" class="card-info-border">
                            @if ($card['helper'])
                                <input class="helper" type="button" value="{{$card['helper']}}">
                            @else
                            <input id="add-helper-button" type="button" onclick="addHelper('{{Auth::user()->id}}','{{Auth::user()->name}}' )" value=" + ">
                            @endif
                        </div>
                        <div id="submit-form" class="card-info-border">
                            <input type="submit" class="card-submit-button" value="submit">
                        </div>
                  </form>
                </div>
  
            </div>
            
            @else
            <!-- The Modal -->
            <div id="myModal{{$card['id']}}" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  
                  <form id="card-info-popup">
                  <div id="general" class="card-info-border">
                            <span><i class="fas fa-align-left"></i></span>
                            <textarea type="text" id="title" maxlength="300" readonly>{{$card['name']}}</textarea>
                            <span>descrition: </span>
                            <textarea type="text" id="description" maxlength="665" readonly>{{$card['description']}}</textarea>
                        </div>

                        <div id="image-uploader" class="card-info-border" readonly>
                            <input type="file">
                        </div>
                        <div id="progress-info" class="card-info-border">
                            <p>{{$card['created_at']}}</p>
                            <select name="status" readonly>
                                <option value="{{$card['in_progress']}}">in progress</option>
                                <option value="{{$card['finished']}}">finished</option>
                            </select>
                        </div>
                        <div id="helper-box" class="card-info-border">
                            @if ($card['helper'])
                                <input class="helper" type="button" value="{{$card['helper']}}">
                            @else
                            <input id="add-helper-button" type="button" onclick="addHelper('{{Auth::user()->id}}','{{Auth::user()->name}}' )" value=" + ">
                            @endif
                        </div>


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

