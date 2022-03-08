@extends('layouts.app')

@section('second script')
	<script src="{{ asset('js/secondScript.js') }}" defer></script>
@endsection
@section('content')

<div class="user-list-container">
	<div class="user-list-container-header">
		<h2>Click here to search for students</h2>
	</div>
	<div class="user-list-search-bar">
		<form id="user-list-form" class="search-bar">
			<input id="user-search-input" placeholder="Search" required>
			<input id="user-search-btn" type="submit" class="card-submit-button" value="{{$board_id}}">
		</form>
	</div>
	<div id="user-list" class="user-list">
		
	</div>
</div>

@endsection
