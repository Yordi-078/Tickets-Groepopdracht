@extends('layouts.app')

@section('content')

<div class="user-list-container">
	<div class="user-list-container-header">
		<h2>Click here to search for students</h2>
	</div>
	<div class="user-list-search-bar">
		<form action="{{ route('search' , $board_id) }}" type="get" class="search-bar">
			<input type="search" name="query" type="search" placeholder="Search" pattern=".*\S.*" required>
			<button class="search-btn" type="submit">
				<span><i class="fa fa-magnifying-glass"></i></span>
			</button>
		</form> 
	</div>
	<div class="user-list">
		@foreach($search as $user)
			<a href="{{ route('addToBoard' , [$board_id, $user['id']]) }}">{{$user['name']}}</a><br>
		@endforeach
	</div>
</div>

@endsection
