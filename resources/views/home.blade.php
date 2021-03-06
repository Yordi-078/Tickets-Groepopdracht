@extends('layouts.app')

@section('content')
<div class="main-button-bar">
</div>
<div class="main-container">
    <div class="home-board-container">
        <div class="home-board-container-header">
        <button id="toggle-board" class="home-board-buttons" onclick="toggleBoard('home-board-content', 'toggle-board')"><i class="fas fa-bars"></i></button>
            @if (Auth::user()->user_role_id == 2 || Auth::user()->user_role_id == 3 )
                <div class="home-board-buttons"><a class=" create-board-button " href="{{ route('createBoard') }}">
                    {{ __('Maak bord') }}
                </a></div>
            @endif
        </div>
        <div class="home-board-content" id="home-board-content">
            @forelse($allBoard as $board)
                <a href="{{ Route('oneBoard', $board['id']) }}" class="general-card card">{{$board["name"]}}</a>    
                @empty
                    @section('second_script')
	                    <script src="{{ asset('js/noBoard.js') }}" defer></script>
                    @endsection
                    <canvas id="canvas"></canvas>
            @endforelse
        </div>
    </div>
</div>
@endsection