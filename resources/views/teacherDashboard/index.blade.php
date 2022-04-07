@extends('layouts.app')
@section('calendar_script')
    <script src="{{ asset('js/calendar_script.js') }}" defer></script>
@endsection
<?php 
    use Illuminate\support\facades\Auth;
    $user_id = Auth::user()->id;
    $array0 = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
    $array1 = ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'];
    $dateFormat = false;
    $calendar = Carbon\Carbon::now();
    $firstDay = Carbon\Carbon::now()->startOfMonth();
    $lastDay = Carbon\Carbon::now()->lastOfMonth();
    $countDaysInMonth = $calendar->daysInMonth;
    $calendarMonth = $calendar->locale('nl')->isoFormat('MMMM YYYY');
?>
@section('content')

<div class="main-button-bar">
    <button btn id="calendar_popup" class="main-button">
        {{ __('Selecteer een andere datum') }}
    </button>
</div>

<div class="main-container">
    <div class="question-board-container">
        <div class="question-board-container-header">
        </div>
        
        <div class="question-board-content" id="board-question-content-box" >
            @foreach($cards as $card)
                @if ($card->updated_at->isoFormat('DD-MM-YYYY') == $selectedDate)
            
                <a onclick="showQuestionPopup('{{$card['user_id']}}','{{$card['helper_id']}}','{{Auth::user()->id}}','{{Auth::user()->name}}','{{$card['id']}}')" href="#" class="general-card card">
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
                @if ($lessonCard->finished_date->isoFormat('DD-MM-YYYY') == $selectedDate)       
                    <a onclick="showPopup('{{$lessonCard['id']}}', '{{$lessonCard['user_id']}}', '{{Auth::user()->id}}')" class="toggle card general-card">
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
                <fieldset class="general card-info-border">
                    <legend>summary</legend>
                    <textarea type="text" id="card-title" class="title" name="name" maxlength="300" required></textarea>
                    <span>description: </span>
                    <textarea type="text" id="card-description" class="description" name="description" maxlength="69" required></textarea>
                </fieldset>

                <fieldset id="image-uploader" class="image-uploader-box card-info-border">
                    <legend>image</legend>
                    <input id="card-upload-image" type="file">
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
                    <div title="" style="background-color:pink;" class="avatar" id="card-helper-avatar"><a id="card-helper-avatar-init" href="#"></a></div>
                </fieldset>

                <div id="userPopup" class="home-user-popup">
                    <div class="user-popup-header">
                        <div id="userPopupBol" title="" class="avatar user-popup-header-avatar"><a href="#" id="userPopupAvatar"></a></div>
                        <div id="userPopupName" class="user-popup-header-username"><a href="#" id="userPopupInit"></a></div>
                        <div id="userPopupEmail" class="user-popup-header-email"></div>
                        <div id="userPopupRole" class="user-popup-header-role"></div>
                    
                    </div>
                    <div id="userPopupProfilePage" class="user-popup-button"><a href="{{ route('viewUserPage', $user_id ) }}">profiel bekijken</a></div>
                    <hr>
                    <div id="userPopupBordInfo" class="user-popup-button"><a href="#">bekijk bord informatie</a></div>
                    <div id="userPopupLeaveBord" class="user-popup-button"><a href="#">bord verlaten</a></div>
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


<div class="calendar" id='calendar-content'>
    <div class="calendar-top-row">
        <button btn id="previous-month"> <----- </button>
        <a>{{ $calendarMonth }}</a>
        <button btn id="next-month"> -----> </button>
    </div>
    
    <div class="calendar-date">
        @for ($i = 0; $i < 7; $i++)
            <div class="calendar-day">
                <a>{{ $array1[$i] }}</a>
            </div>
        @endfor
        @for ($i = 0; $i < $countDaysInMonth; $i++)
            @if($dateFormat == false)
            @php $j=0; @endphp
                @while ($dateFormat == false)
                    
                
                    @if($firstDay->isoFormat('dd') == $array0[$j])
                        @php
                            $dateFormat = true
                        @endphp
                    @else
                        <div class="calendar-number"></div>
                    @endif
                
                    @php $j++; @endphp
                @endwhile
            @endif

            <div class="calendar-number">
                <a href="{{ route('dateSelected', [$board_id , $firstDay->isoFormat('DD-MM-YYYY')]) }}" {{ $firstDay->isoFormat('DD-MM-YYYY') == $calendar->isoFormat('DD-MM-YYYY') ? "class=calendar-today"  : ''}} > {{ $firstDay->isoFormat('DD') }} </a>
            </div>

            @if ($dateFormat !== false)
                @php
                    $firstDay->add(1, 'day')
                @endphp
            @endif
        @endfor
    </div>
</div>

@endsection


