@extends('layouts.app')

<?php 

use Illuminate\support\facades\Auth;
$user_id = Auth::user()->id;

?>

@section('content')
<div class="board-page-header">
    @if (Auth::user()->user_role == 'teacher' || Auth::user()->user_role == 'admin' )
        <a id="add-student-button" class="dropdown-item" href="{{ route('addStudentsToBoard', $thisBoard['id']) }}">
            {{ __('Add students') }}
        </a>
    @endif
    @if (Auth::user()->user_role == 'teacher')
        <a id="add-student-button" class="dropdown-item" href="{{ route('teacherDashboard',$thisBoard['id']) }}">
            {{ __('Teacher Dashboard') }}
        </a>
    @endif
    <a href="{{ route('viewUsersFromBoard', $thisBoard['id']) }}" id="add-student-button">View all users from this board</a>
</div>



<div class="question-board-container">
    <div class="board-header">
        
        <button id="toggle-board" class="home-buttons" onclick="toggleBoard()"><i class="fas fa-bars"></i></button>
        <a href="{{ url('boardCrud/createCard', $thisBoard['id']) }}" class="home-buttons">Add Card</a>

    </div>
    <div class="flex-row" id="board-question-content-box" >
        @foreach($cards as $card)
            
            <a onclick="showQuestionPopup('{{$card['user_id']}}','{{$card['helper_id']}}','{{Auth::user()->id}}','{{Auth::user()->name}}','{{$card['id']}}')" href="#" class="cards flex-row">
                <button class="card-popup-button">
                    <i class="far fa-eye"></i>
                </button>
                {{$card->status == "finished" ? "//" : ''}}
                {{$card[""]}}
                {{$card["name"]}}
            </a>  
            @endforeach

            <div class="modal" id="loader-screen">
                <div class="loader-screen">
                    <div class="loader-wrap">
                      <span class="loader letter-1">l</span>
                      <span class="loader letter-2">o</span>
                      <span class="loader letter-3">a</span>
                      <span class="loader letter-4">d</span>
                      <span class="loader letter-5">i</span>
                      <span class="loader letter-6">n</span>
                      <span class="loader letter-7">g</span>
                      <span class="loader letter-8">.</span>
                      <span class="loader letter-9">.</span>
                      <span class="loader letter-10">.</span>
                    </div>
                </div>
            </div>
            <div id="cardModal" class="modal">
                
                <div class="modal-content">
                    <span id="card-owner" class="card-info-owner"></span>
                    <span id="close-popup" class="close">&times;</span>
                  
                    <form id="card-info-popup" class="card-info-popup">
                      
                      @csrf
                      <fieldset id="general" class="card-info-border">
                          <legend>summary</legend>
                            <textarea type="text" id="card-title" class="title" name="name" maxlength="300" required></textarea>
                            <span>description: </span>
                            <textarea type="text" id="card-description" class="description" name="description" maxlength="665" required></textarea>
                        </fieldset>

                        <fieldset id="image-uploader" class="card-info-border">
                            <legend>image</legend>
                            <input id="card-upload-image" type="file">
                        </fieldset>

                        <fieldset id="progress-info" class="card-info-border">
                            <legend>card info</legend>
                            <p id="card-created-at"></p>
                            
                            <select name="status" id="card-status">
                                <option name='status' value="in_progress" >in progress</option>
                                <option name='status' value="finished" >finished</option>
                            </select>
                        </fieldset>



                        <fieldset id="helper-box" class="card-info-border">
                            <legend id="helper">no one is helping this card</legend>
                            <input id="remove-helper-button" class="helper-buttons" type="button" value=" - ">
                            <input id="add-helper-button" class="helper-buttons" type="button"value=" + ">
                            <div onclick="showUserData('Anthony Inocencio Ramos', 'AIR', 'navy')" title="" style="background-color:pink;" class="avatar" id="card-helper-avatar"><a id="card-helper-avatar-init" href="#"></a></div>
                        </fieldset>

                        <div id="userPopup">
                            <div class="user-popup-header">
                                <div id="userPopupBol" title="" class="avatar user-popup-header-avatar"><a href="#" id="userPopupAvatar"></a></div>
                                <div id="userPopupName" class="user-popup-header-username"><a href="#" id="userPopupInit"></a></div>
                            </div>
                            <div id="userPopupProfilePage" class="user-popup-button"><a href="{{ route('viewUserPage', $user_id ) }}">profiel bekijken</a></div>
                            <hr>
                            <div id="userPopupBordInfo" class="user-popup-button"><a href="#">bekijk bord informatie</a></div>
                            <div id="userPopupLeaveBord" class="user-popup-button"><a href="#">bord verlaten</a></div>
                        </div>
                        
                        <fieldset id="card-submit-form" class="card-info-border">
                            <input type="submit" class="card-submit-button" value="submit">
                        </fieldset>
                        
                        
                        <fieldset class="avatarContainer card-info-border">
                            <legend>upvoters</legend>
                            <div class="vote-container">
                                <a id="card-upvote-question" class="vote-thumb"><i class="fas fa-thumbs-up"></i></a>
                                <a id="question-upvote-count" class="vote-count">-</a>
                                <a id="card-downvote-question" class="vote-thumb"><i class="fas fa-thumbs-down"></i></a>
                            </div>
                            <div id="cardAvatarContainer" class="card-avatar-container">

                            </div>
                        </fieldset>

                  </form>
                     </div>
  
            </div>
            



    </div>

    
</div>
<div class="lesson-board-container">
    <div class="board-header">
    @if (Auth::user()->user_role == 'teacher' || Auth::user()->user_role == 'admin')
        <a href="{{ url('boardCrud/createLessonCard', $thisBoard['id']) }}" class="home-buttons">Add Card</a>
    @endif
    </div>
    
    <div class="flex-row" id="board-lesson-content-box" >
        @foreach($lessonCards as $lessonCard)
 
        <a onclick="showPopup('{{$lessonCard['id']}}', '{{$lessonCard['user_id']}}', '{{Auth::user()->id}}')" class="toggle cards flex-row">{{$lessonCard["name"]}}<button class="card-popup-button"><i class="far fa-eye"></i></button></a> 
        
        @endforeach

        
      
        <div id="lessonModal" class="modal">
        
        
    
            <div class="modal-content">
            <span id="lesson-owner" class="card-info-owner"></span>
              <span id="close-lesson-popup" class="close">&times;</span>
              <form class="card-info-popup">
                    <fieldset id="general" class="card-info-border">
                    <legend>summary</legend>
                        <textarea type="text" id="lesson-title" class="title" name="name" maxlength="300" required></textarea>
                        <span>description: </span>
                        <textarea type="text" id="lesson-description" class="description" name="description" maxlength="665" required></textarea>
                    </fieldset>

                    <fieldset id="image-uploader" class="card-info-border">
                    <legend>lesson date</legend>
                        <p>datum van lesson komt hier.</p>
                        <p id="lesson-start-date" ></p>
                    </fieldset>
                    <a id="lesson-card-info-test"></a>
                    <a href="{{ url('storeLessonUpVote', [$lessonCard['id'], $thisBoard['id']]) }}" class="home-buttons">Upvote</a>
              </form>
            </div>
        </div>

    </div>
</div>
@endsection