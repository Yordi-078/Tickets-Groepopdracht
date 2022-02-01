@extends('layouts.app')

<?php 

use Illuminate\support\facades\Auth;
$user_id = Auth::user()->id;

?>

@section('content')

<div class="">
    <div class="flex-row" id="board-question-content-box" >
        @foreach($cards as $card)
            
            <a href="#" class="cards flex-row">
                <button class="card-popup-button" onclick="showQuestionPopup('myModal{{$card['id']}}','{{$card['user_id']}}','{{$card['helper_id']}}','{{$card['id']}}','{{Auth::user()->id}}')">
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
                            <select name="status" id="status">
                                <option name='status' value="in_progress" {{$card->status == "in_progress" ? 'selected' : '' }}>in progress</option>
                                <option name='status' value="finished"    {{$card->status == "finished" ? 'selected' : '' }}>finished</option>
                            </select>
                        </div>



                        <div id="helper-box" class="card-info-border">
                            <p id="helper-{{$card['id']}}">no one is helping this card</p>
                            <input id="remove-helper-button" class="helper-buttons" type="button" onclick="destroyHelper('{{$card['id']}}')" value=" - ">
                            <p id="card-{{$card['id']}}-helper-email">email: </p>
                            <p id="card-{{$card['id']}}-helper-name">name: </p>
                            <p id="card-{{$card['id']}}-helper-role">role: </p>
                            
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
                            <p data-card-id="" id="card-{{$card['id']}}-helper-email">email: </p>
                            <p data-card-id="" id="card-{{$card['id']}}-helper-name">name: </p>
                            <p data-card-id="" id="card-{{$card['id']}}-helper-role">role: </p>
                            
                        </div>


                  </form>
                </div>
  
            </div>

            @endif 
            @endforeach
    </div>

    
</div>

@endsection