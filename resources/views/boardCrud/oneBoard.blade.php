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
            
            <a href="#" class="cards flex-row">
                <button class="card-popup-button" onclick="showQuestionPopup('{{$card['user_id']}}','{{$card['helper_id']}}','{{Auth::user()->id}}','{{Auth::user()->name}}','{{$card['id']}}')">
                    <i class="far fa-eye"></i>
                </button>
                {{$card->status == "finished" ? "//" : ''}}
                {{$card[""]}}
                {{$card["name"]}}
            </a>  
            @endforeach

            

            <!-- The Modal -->
            <div id="cardModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span id="card-owner" class="card-info-owner"></span>
                    <span id="close-popup" onclick="history.go(-0)" class="close">&times;</span>
                  
                    <form id="card-info-popup" class="card-info-popup">
                      
                      @csrf
                      <fieldset id="general" class="card-info-border">
                            <span><i class="fas fa-align-left"></i></span>
                            <textarea type="text" id="card-title" class="title" name="name" maxlength="300" required></textarea>
                            <span>description: </span>
                            <textarea type="text" id="card-description" class="description" name="description" maxlength="665" required></textarea>
                        </fieldset>

                        <fieldset id="image-uploader" class="card-info-border">
                            <input id="upload-image" type="file">
                        </fieldset>

                        <fieldset id="progress-info" class="card-info-border">
                            <p id="card-created-at"></p>
                            
                            <select name="status" id="card-status">
                                <option name='status' value="in_progress" >in progress</option>
                                <option name='status' value="finished" >finished</option>
                            </select>
                        </fieldset>



                        <fieldset id="helper-box" class="card-info-border">
                            <p id="helper">no one is helping this card</p>
                            <input id="remove-helper-button" class="helper-buttons" type="button" value=" - "><!-- onclick destroyHelper('{{$card['id']}}') --> 
                            <input id="add-helper-button" class="helper-buttons" type="button"value=" + "><!-- onclick destroyHelper('{{$card['id']}}') --> 
                            <div onclick="showUserData('Anthony Inocencio Ramos', 'AIR', 'navy')" title="" style="background-color:pink;" class="avatar" id="card-helper-avatar"><a id="card-helper-avatar-init" href="#"></a></div>
                        </fieldset>
                        <div id="userPopup">
                            <div class="user-popup-header">
                                <div id="userPopupBol" title="" class="avatar user-popup-header-avatar"><a href="#" id="userPopupAvatar"></a></div>
                                <div id="userPopupName" class="user-popup-header-username"><a href="#" id="userPopupInit"></a></div>
                            </div>
                            <div id="userPopupProfilePage" class="user-popup-button"><a href="">profiel bekijken</a></div>
                            <hr>
                            <div id="userPopupBordInfo" class="user-popup-button"><a href="#">bekijk bord informatie</a></div>
                            <div id="userPopupLeaveBord" class="user-popup-button"><a href="#">bord verlaten</a></div>
                        </div>
                        
                        <fieldset id="submit-form" class="card-info-border">
                            <input type="submit" class="card-submit-button" value="submit">
                        </fieldset>
                        
                        <a href="#" class="home-buttons" id="card-upvote-question">Upvote</a>
                        <div id="cardAvatarContainer" class="avatarContainer card-info-border"></div>

                  </form>
                     </div>
  
            </div>
            



    </div>

    
</div>
<div class="lesson-board-container">
    <div class="board-header">
        <a href="{{ url('boardCrud/createLessonCard', $thisBoard['id']) }}" class="home-buttons">Add Card</a>
    </div>
    
    <div class="flex-row" id="board-lesson-content-box" >
        @foreach($lessonCards as $lessonCard)
 
        <a onclick="showPopup({{$lessonCard['id']}})" class="toggle cards flex-row">{{$lessonCard["name"]}}<button class="card-popup-button"><i class="far fa-eye"></i></button></a> 
        @endforeach
        <!-- The Modal -->

        
      
        <div id="myModalLesson" class="modal">
        
            <!-- Modal content -->
    
            <div class="modal-content">
              <span onclick="history.go(-1)" class="close">&times;</span>
              <form class="card-info-popup">
                    <fieldset id="general" class="card-info-border">
                        <span><i class="fas fa-align-left"></i></span>
                        <textarea type="text" id="lessoncard-title" class="title" name="name" maxlength="300" required></textarea>
                        <span>description: </span>
                        <textarea type="text" id="lessoncard-description" class="description" name="description" maxlength="665" required></textarea>
                    </fieldset>

                    <fieldset id="image-uploader" class="card-info-border">
                        <input id="upload-image" type="file">
                    </fieldset>
                    <a id="lesson-card-info-test"></a>
                    <a id="lesson-upvote" class="home-buttons">Upvote</a>
              </form>
            </div>
        </div>

    </div>
</div>
@endsection

