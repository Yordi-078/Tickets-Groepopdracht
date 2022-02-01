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
<a href="{{ route('viewUsersFromBoard', $thisBoard['id']) }}" id="allUsersBtn">View all users from this board</a>
<div class="question-board-container">
    <div class="board-header">
        
        <button id="toggle-board" class="home-buttons" onclick="toggleBoard()"><i class="fas fa-bars"></i></button>
        <a href="{{ url('boardCrud/createCard', $thisBoard['id']) }}" class="home-buttons">Add Card</a>

    </div>
    <div class="flex-row" id="board-question-content-box" >
        @foreach($cards as $card)
            
            <a href="#" class="cards flex-row">
                <button class="card-popup-button" onclick="showQuestionPopup('myModal{{$card['id']}}','{{$card['user_id']}}','{{$card['helper_id']}}')">
                    <i class="far fa-eye"></i>
                </button>
                {{$card->status == "finished" ? "//" : ''}}
                {{$card[""]}}
                {{$card["name"]}}
            </a> 

            @if ($user_id == $card["user_id"])
            <!-- The Modal -->
            <div id="myModal{{$card['id']}}" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span id="card-owner" class="card-info-owner"></span>
                    <span id="close-popup" onclick="history.go(-0)" class="close">&times;</span>
                  
                  <form  id="card-info-popup" action="{{ url('updateCard', [$card['id'], $card['board_id']]) }}" method="POST">
                      
                      @csrf
                      <div id="general" class="card-info-border">
                            <span><i class="fas fa-align-left"></i></span>
                            <textarea type="text" id="title" name="name" maxlength="300" required>{{$card['name']}}</textarea>
                            <span>description: </span>
                            <textarea type="text" id="description" name="description" maxlength="665" required>{{$card['description']}}</textarea>
                        </div>

                        <div id="image-uploader" class="card-info-border">
                            <input type="file">
                        </div>

                        <div id="progress-info" class="card-info-border">
                            <p>{{$card['created_at']}}</p>
                            <select name="status" id="status">
                                <option name='status' value="in_progress" {{$card->status == "in_progress" ? 'selected' : '' }}>in progress</option>
                                <option name='status' value="finished"    {{$card->status == "finished" ? 'selected' : '' }}>finished</option>
                            </select>
                        </div>



                        <div id="helper-box" class="card-info-border">
                            <p id="helper-{{$card['id']}}">no one is helping this card</p>
                            <input id="remove-helper-button" class="helper-buttons" type="button" onclick="destroyHelper('{{$card['id']}}')" value=" - ">
                            <div onclick="showUserData('Anthony Inocencio Ramos', 'AIR', 'navy')" title="" style="background-color:pink;" class="avatar" id="card-{{$card['id']}}-helper-avatar"><a id="card-{{$card['id']}}-helper-avatar-init" href="#"></a></div>
                        </div>
                        <div id="userPopup">
                            <div class="user-popup-header">
                                <div id="userPopupBol" title="" class="avatar user-popup-header-avatar"><a href="#" id="userPopupAvatar"></a></div>
                                <div id="userPopupName" class="user-popup-header-username"><a href="#" id="userPopupInit"></a></div>
                            </div>
                            <div id="userPopupProfilePage" class="user-popup-button"><a href="#">profiel informatie wijzigen</a></div>
                            <hr>
                            <div id="userPopupBordInfo" class="user-popup-button"><a href="#">bekijk bord informatie</a></div>
                            <div id="userPopupLeaveBord" class="user-popup-button"><a href="#">bord verlaten</a></div>
                        </div>
                        
                        <div id="submit-form" class="card-info-border">
                            <input type="submit" class="card-submit-button" value="submit">
                        </div>
                        <a href="{{ url('storeCardUpVote', [$card['id'], $thisBoard['id']]) }}" class="home-buttons">Upvote</a>

                  </form>
                </div>
  
            </div>
            
            @else
            <!-- The Modal -->
            <div id="myModal{{$card['id']}}" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                <span id="card-owner" class="card-info-owner"></span>
                  <span class="close">&times;</span>
                  <form id="card-info-popup">
                    @csrf


                  <div id="general" class="card-info-border">
                            <span><i class="fas fa-align-left"></i></span>
                            <textarea type="text" id="title" maxlength="300" readonly>{{$card['name']}}</textarea>
                            <span>description: </span>
                            <textarea type="text" id="description" maxlength="665" readonly>{{$card['description']}}</textarea>
                        </div>

                        <div id="image-uploader" class="card-info-border" readonly>
                            <input type="file">
                        </div>

                        <div id="progress-info" class="card-info-border">
                            <p>{{$card['created_at']}}</p>
                            <select name="status" id="status">
                                <option name='status' value="1">in progress</option>
                                <option name='status' value="2">finished</option>
                            </select>
                        </div>

                        <div id="helper-box" class="card-info-border">
                            <p id="helper-{{$card['id']}}" class="helper-status">no one is helping this card</p>
                            <input id="remove-helper-button" class="helper-buttons" type="button" onclick="destroyHelper('{{$card['id']}}')" value=" - ">
                            <input id="add-helper-button" class="helper-buttons" type="button" onclick="addHelper('{{Auth::user()->id}}','{{Auth::user()->name}}','{{Auth::user()->email}}','{{Auth::user()->user_role}}','{{$card['id']}}' )" value=" + ">
                            <div onclick="showUserData('Anthony Inocencio Ramos', 'AIR', 'navy')" title="" style="background-color:pink;" class="avatar" id="card-{{$card['id']}}-helper-avatar"><a id="card-{{$card['id']}}-helper-avatar-init" href="#"></a></div>
                        </div>
                        <div id="userPopup">
                            <div class="user-popup-header">
                                <div id="userPopupBol" title="" class="avatar user-popup-header-avatar"><a href="#" id="userPopupAvatar"></a></div>
                                <div id="userPopupName" class="user-popup-header-username"><a href="#" id="userPopupInit"></a></div>
                            </div>
                            <div id="userPopupProfilePage" class="user-popup-button"><a href="#">profiel informatie wijzigen</a></div>
                            <hr>
                            <div id="userPopupBordInfo" class="user-popup-button"><a href="#">bekijk bord informatie</a></div>
                            <div id="userPopupLeaveBord" class="user-popup-button"><a href="#">bord verlaten</a></div>
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
        <a href="{{ url('boardCrud/createLessonCard', $thisBoard['id']) }}" class="home-buttons">Add Card</a>
    </div>
    
    <div class="flex-row" id="board-lesson-content-box" >
        @foreach($lessonCards as $lessonCard)
 
        <a onclick="showPopup('myModalLesson{{$lessonCard['id']}}',{{$thisBoard['id']}})" class="toggle cards flex-row">{{$lessonCard["name"]}}<button class="card-popup-button"><i class="far fa-eye"></i></button></a> 
        
        <!-- The Modal -->

        
      
        <div id="myModalLesson{{$lessonCard['id']}}" class="modal">
        
            <!-- Modal content -->
    
            <div class="modal-content">
              <span onclick="history.go(-1)" class="close">&times;</span>
              <form>
                  <a id="lesson-card-info-test">hello</a>
                <a href="{{ url('storeLessonUpVote', [$lessonCard['id'], $thisBoard['id']]) }}" class="home-buttons">Upvote</a>
              </form>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection

