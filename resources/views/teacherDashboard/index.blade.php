@extends('layouts.app')
@section('calendar_script')
    <script src="{{ asset('js/calendar_script.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endsection
<?php 
    use Illuminate\support\facades\Auth;
    $user_id = Auth::user()->id;
    if($selectedDate == false){
        $selectedDate = Carbon\Carbon::now()->isoFormat('DD-MM-YYYY');
    }
?>

@section('content')

<form method="POST" action="{{ route('dateCreator',[$board_id] )}} ">
<div class="main-button-bar">
        @csrf

        <button type="button" class="main-button">
            <label>Selecteer een andere datum: <input type="text" id="datepicker" name="datepicker" autocomplete="off"></label>
        </button>
        
        <button class="main-button" type="submit">Ga naar datum</button>
</div>
</form>



<div class="main-container">
    <div class="question-board-container">
        <div class="question-board-container-header">

            <button id="toggle-card" class="home-board-buttons" onclick="toggleBoard('board-question-content-box', 'toggle-card')"><i class="fas fa-bars"></i></button>

        </div>
        
        <div class="question-board-content" id="board-question-content-box" >
            @foreach($cards as $card)
                @if ($card->updated_at->isoFormat('DD-MM-YYYY') == $selectedDate)
                    <a id="card-{{$card['id']}}" onclick="showQuestionPopup('{{$card['user_id']}}','{{$card['helper_id']}}','{{Auth::user()->id}}','{{Auth::user()->name}}','{{$card['id']}}','{{Auth::user()->user_role_id}}')" class="general-card card">
                        <i class="far fa-eye"></i>
                        {{$card->status == "finished" ? "//" : ''}}
                        {{$card[""]}}
                        {{$card["name"]}}
                    </a>   
                @endif
            @endforeach
        </div>
    </div>
    
    <div class="lesson-board-container">
        <div class="lesson-board-container-header">
           
        </div>
    
        <div class="lesson-board-content" id="board-lesson-content-box" >
            @foreach($lessonCards as $lessonCard)
                @if ($lessonCard->updated_at->isoFormat('DD-MM-YYYY') == $selectedDate)     
                    <a id="LessonCard-{{$lessonCard['id']}}" onclick="showPopup('{{$lessonCard['id']}}', '{{$lessonCard['user_id']}}', '{{Auth::user()->id}}', '{{$lessonCard->Board->id}}')" class="toggle card general-card">
                        <i class="far fa-eye"></i>
                        {{$lessonCard["name"]}}
                    </a> 
                @endif
        
            @endforeach
        </div>
    </div>
</div>

<div id="loader-screen" class="modal">
    <div class="loader-screen">
        <div class="loader-wrap">
          <span class="loader letter-0">l</span>
          <span class="loader letter-1">a</span>
          <span class="loader letter-2">d</span>
          <span class="loader letter-3">e</span>
          <span class="loader letter-4">n</span>
          <span class="loader letter-5">.</span>
          <span class="loader letter-8">.</span>
          <span class="loader letter-9">.</span>
        </div>
    </div>
</div>

<div id="cardModal" class="modal">
    <div class="modal-content">
        <span id="card-owner" class="card-info-owner"></span>
        <span id="close-popup" class="close">&times;</span>

            <form id="card-info-popup" enctype="multipart/form-data" class="card-info-popup">
                @csrf
                <input name="card_id" type="hidden" id="card-id">
                <fieldset class="general card-info-border">
                    <legend>Overzicht: </legend>
                    <textarea type="text" id="card-title" class="title" name="name" maxlength="300" required></textarea>
                    <span>Beschrijving: </span>
                    <textarea type="text" id="card-description" class="description" name="description" maxlength="69" required></textarea>
                </fieldset>

                <fieldset id="image-uploader" class="image-uploader-box card-info-border">
                    <legend>Afbeelding</legend>
                    <input type="file" name="image" placeholder="Choose image" id="card-upload-image" onchange="loadFile(event)" accept=".gif,.jpg,.jpeg,.png">
                    @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <a class="delete-card-image-button" id="deleteImage">verwijder</a>
                    <p><img id="uploaded-card-image" width="150"/></p>
                    
                </fieldset>
            
                <fieldset class="progress-info card-info-border">
                    <legend>Kaart info</legend>
                    <p id="card-created-at"></p>
                    <select name="status" id="card-status" class="card-status">
                        <option name='status' value="in_progress" >Aan de gang</option>
                        <option name='status' value="finished" >Afgerond</option>
                    </select>
                </fieldset>
                
                <fieldset id="helper-box" class="helper-box card-info-border">
                    <legend id="helper">Niemand is aan het helpen</legend>
                    <input id="remove-helper-button" class="helper-buttons" type="button" value=" - ">
                    <input id="add-helper-button" class="helper-buttons" type="button"value=" + ">
                    <div title="" class="avatar" id="card-helper-avatar"><a id="card-helper-avatar-init"></a></div>
                </fieldset>

                <div id="user-modal" class="modal">
                    <div id="userPopup" class="home-user-popup">
                    <span id="close-upvoter-popup" class="close">&times;</span>
                        <div class="user-popup-header">
                            <div id="userPopupBol" title="" class="avatar user-popup-header-avatar"><a id="userPopupAvatar"></a></div>
                            <br>
                            <div id="userPopupName" class="user-popup-header-username"><a id="userPopupInit"></a></div>
                            <div id="userPopupRole" class="user-popup-header-role"></div>
                            <br><br>
                            <a id="profielPageButton">Profiel Pagina</a>
                            <hr>
                            <div id="userPopupEmail" class="user-popup-header-email"></div> 
                            <hr>
                        </div>
                    </div>
                </div>                
                        
                <fieldset id="card-submit-form" class="card-submit-form card-info-border">
                    <input type="submit" class="card-submit-button" value="submit">
                </fieldset>
                        
                        
                <fieldset class="avatarContainer card-info-border">
                    <legend>Upvoters</legend>
                    <div class="vote-container">
                        <a id="card-upvote-question" class="vote-thumb"><i class="fas fa-thumbs-up"></i></a>
                        <a id="question-upvote-count" class="vote-count">-</a>
                        <a id="card-downvote-question" class="vote-thumb"><i class="fas fa-thumbs-down"></i></a>
                    </div>
                    
                    <div id="cardAvatarContainer" class="card-avatar-container">
                        <div id="upvoteUserPopupBol" title="" class="upvote-user-popup-bol"><a id="upvoteUserAvatar"></a></div>
                        <div id="upvoteUserPopupName" class="upvote-user-popup-username"><a href="{{ route('viewUserPage', $user_id ) }}">Name</a></div>
                        <div id="upvoteUserPopupEmail" class="upvote-user-popup-email"><p>Email</p></div>
                        <div id="upvoteUserPopupRole" class="upvote-user-popup-role"><p>Role</p></div>
                    </div>
                </fieldset>

            </form>
        </div>
    </div>
</div>


<div id="lessonModal" class="modal">
    <div class="modal-content">
        <span id="lesson-owner" class="card-info-owner"></span>
        <span id="close-lesson-popup" class="close">&times;</span>

        <form id='lesson-info-popup' enctype="multipart/form-data" class="card-info-popup">
            <fieldset id="general" class="general card-info-border">
                <input type="hidden" name="lesson_id" id="lesson-id">
                <legend>Overzicht: </legend>
                <textarea type="text" id="lesson-title" class="title" name="name" maxlength="300" required></textarea>
                <span>Beschrijving: </span>
                <textarea type="text" id="lesson-description" class="description" name="description" maxlength="665" required></textarea>
            </fieldset>

            <fieldset id="image-uploader" class="image-uploader-box card-info-border">
                <legend>Lesdatum</legend>
                <p>datum van lesson komt hier.</p>
                <p id="lesson-start-date" ></p>
            </fieldset>

            <fieldset class="lessonAvatarContainer card-info-border">
                <div class="vote-container">
                    <a id="card-upvote-lesson" class="vote-thumb"><i class="fas fa-thumbs-up"></i></a>
                    <a id="lesson-upvote-count" class="vote-count">-</a>
                    <a id="card-downvote-lesson" class="vote-thumb"><i class="fas fa-thumbs-down"></i></a>
                </div>
                <div id="lessonAvatarContainer" class="card-avatar-container">
                </div>
            </fieldset>

            <div id="lesson-user-modal" class="modal">
                <div id="userPopup" class="home-user-popup">
                <span id="close-lesson-upvoter-popup" class="close">&times;</span>
                    <div class="user-popup-header">
                        <div id="userLessonPopupBol" title="" class="avatar user-popup-header-avatar"><a id="userLessonPopupAvatar"></a></div>
                        <br>
                        <div id="userLessonPopupName" class="user-popup-header-username"><a id="userLessonPopupInit"></a></div>
                        <div id="userLessonPopupRole" class="user-popup-header-role"></div>
                        <br><br>
                        <a id="LessonProfielPageButton">Profiel Pagina</a>
                        <hr>
                        <div id="userLessonPopupEmail" class="user-popup-header-email"></div> 
                        <hr>
                    </div>
                </div>
            </div>

            <fieldset class="progress-info card-info-border">
                    <legend>Kaart status</legend>
                    <p id="card-created-at"></p>
                    <select name="status" id="lesson-card-status" class="lesson-card-status">
                        <option name='status' value="in_progress" >Aan de gang</option>
                        <option name='status' value="finished" >Afgerond</option>
                    </select>
                </fieldset>

            <fieldset class="card-info-border">
            <legend>Reviews</legend>
            <a id="reviewLink"> Geef uw mening </a>
            <a id="allReviewsLink"> Alle beoordelingen </a>
            </fieldset>

            <fieldset id="lessonCard-submit-form" class="card-submit-form card-info-border">
                    <input type="submit" class="card-submit-button" value="submit">
            </fieldset>
        </form>
    </div>
</div>
@endsection