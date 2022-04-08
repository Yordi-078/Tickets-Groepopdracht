@extends('layouts.app')

<?php 

use Illuminate\support\facades\Auth;
$user_id = Auth::user()->id;

?>

@section('content')
<div class="main-button-bar">
    @if (Auth::user()->user_role_id == 2 || Auth::user()->user_role_id == 3 )
        <a id="add-student-button" class="main-button" href="{{ route('addStudentsToBoard', $thisBoard['id']) }}">
            {{ __('Add students') }}
        </a>
    @endif
    @if (Auth::user()->user_role_id == 2)
        <a id="add-student-button" class="main-button" href="{{ route('teacherDashboard',$thisBoard['id']) }}">
            {{ __('Teacher Dashboard') }}
        </a>
    @endif
    <a href="{{ route('allBoardUsers', $thisBoard['id']) }}" class="main-button" id="add-student-button">all board users</a>
</div>

<div class="main-container">
    <div class="question-board-container">
        <div class="question-board-container-header">

            <button id="toggle-board" class="home-board-buttons" onclick="toggleBoard()"><i class="fas fa-bars"></i></button>
            <a href="{{ url('boardCrud/createCard', $thisBoard['id']) }}" class="home-board-buttons">Add Card</a>

        </div>
        
        <div class="question-board-content" id="board-question-content-box" >
            @foreach($cards as $card)
            
            <a onclick="showQuestionPopup('{{$card['user_id']}}','{{$card['helper_id']}}','{{Auth::user()->id}}','{{Auth::user()->name}}','{{$card['id']}}')" class="general-card card">
                <i class="far fa-eye"></i>
                {{$card->status == "finished" ? "//" : ''}}
                {{$card[""]}}
                {{$card["name"]}}
            </a>   
            @endforeach
        </div>
    </div>
    
    <div class="lesson-board-container">
        <div class="lesson-board-container-header">
            @if (Auth::user()->user_role_id == 2 || Auth::user()->user_role_id == 3)
                <a href="{{ url('boardCrud/createLessonCard', $thisBoard['id']) }}" class="home-board-buttons">Add Card</a>
            @endif
        </div>
    
        <div class="lesson-board-content" id="board-lesson-content-box" >
            @foreach($lessonCards as $lessonCard)
 
                <a onclick="showPopup('{{$lessonCard['id']}}', '{{$lessonCard['user_id']}}', '{{Auth::user()->id}}')" class="toggle card general-card">
                    <i class="far fa-eye"></i>
                    {{$lessonCard["name"]}}
                </a> 
        
            @endforeach
        </div>
    </div>
</div>

<div id="loader-screen" class="modal">
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
                  
            <form id="card-info-popup" enctype="multipart/form-data" class="card-info-popup">
                      
                @csrf
                <fieldset class="general card-info-border">
                    <legend>summary</legend>
                    <textarea type="text" id="card-title" class="title" name="name" maxlength="300" required></textarea>
                    <span>description: </span>
                    <textarea type="text" id="card-description" class="description" name="description" maxlength="69" required></textarea>
                </fieldset>

                <fieldset id="image-uploader" class="image-uploader-box card-info-border">
                    <legend>image</legend>
                    <input type="file" name="image" placeholder="Choose image" id="card-upload-image" onchange="loadFile(event)" accept=".gif,.jpg,.jpeg,.png">
                    @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <p><img id="uploaded-card-image" width="150"/></p>
                    <a id="deleteImage">delete</a>
                </fieldset>

                <fieldset class="progress-info card-info-border">
                    <legend>card info</legend>
                    <p id="card-created-at"></p>

                    <select name="status" id="card-status" class="card-status">
                        <option name='status' value="in_progress" >in progress</option>
                        <option name='status' value="finished" >finished</option>
                    </select>
                </fieldset>

                <fieldset id="helper-box" class="helper-box card-info-border">
                    <legend id="helper">no one is helping this card</legend>
                    <input id="remove-helper-button" class="helper-buttons" type="button" value=" - ">
                    <input id="add-helper-button" class="helper-buttons" type="button"value=" + ">
                    <div title="" class="avatar" id="card-helper-avatar"><a id="card-helper-avatar-init" href="#"></a></div>
                </fieldset>

                <div id="userPopup" class="home-user-popup">
                    <div class="user-popup-header">
                        <div id="userPopupBol" title="" class="avatar user-popup-header-avatar"><a href="#" id="userPopupAvatar"></a></div>
                        <br>
                        <div id="userPopupName" class="user-popup-header-username"><a href="{{ route('viewUserPage', $user_id ) }}" id="userPopupInit"></a></div>
                        <div id="userPopupEmail" class="user-popup-header-email"></div>
                        <div id="userPopupRole" class="user-popup-header-role"></div>
                    </div>
                </div>
                        
                <fieldset id="card-submit-form" class="card-submit-form card-info-border">
                    <input type="submit" class="card-submit-button" value="submit">
                </fieldset>
                        
                        
                <fieldset class="avatarContainer card-info-border">
                    <legend>upvoters</legend>
                    <div class="vote-container">
                        <a id="card-upvote-question" class="vote-thumb"><i class="fas fa-thumbs-up"></i></a>
                        <a id="question-upvote-count" class="vote-count">-</a>
                        <a id="card-downvote-question" class="vote-thumb"><i class="fas fa-thumbs-down"></i></a>
                    </div>
                    <div id="cardAvatarContainer" class="card-avatar-container"></div>
                </fieldset>

            </form>
        </div>
    </div>
</div>

<div id="lessonModal" class="modal">
    <div class="modal-content">
        <span id="lesson-owner" class="card-info-owner"></span>
        <span id="close-lesson-popup" class="close">&times;</span>

        <form class="card-info-popup">
            <fieldset id="general" class="general card-info-border">
                <legend>summary</legend>
                <textarea type="text" id="lesson-title" class="title" name="name" maxlength="300" required></textarea>
                <span>description: </span>
                <textarea type="text" id="lesson-description" class="description" name="description" maxlength="665" required></textarea>
            </fieldset>

            <fieldset id="image-uploader" class="image-uploader-box card-info-border">
                <legend>lesson date</legend>
                <p>datum van lesson komt hier.</p>
                <p id="lesson-start-date" ></p>
            </fieldset>

            <fieldset class="avatarContainer card-info-border">
                <div class="vote-container">
                    <a id="card-upvote-lesson" class="vote-thumb"><i class="fas fa-thumbs-up"></i></a>
                    <a id="lesson-upvote-count" class="vote-count">-</a>
                    <a id="card-downvote-lesson" class="vote-thumb"><i class="fas fa-thumbs-down"></i></a>
                </div>
                <div id="lessonAvatarContainer" class="card-avatar-container">

                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection