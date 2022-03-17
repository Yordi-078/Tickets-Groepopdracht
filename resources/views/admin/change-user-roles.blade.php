@extends('layouts.app')
@section('second script')
	<script src="{{ asset('js/changeUserRoleScript.js') }}" defer></script>
@endsection
@section('content')

  <div class="main-container">
	<div class="user-list-container">
		<div class="user-list-container-header">
			<div class="user-list-search-bar">
				<form id="user-list-form" class="search-bar">
					<input id="user-search-input" class="user-search-input" placeholder="Search" required>
					<div id="user-search-icon" class="user-search-icon"><i class="fa fa-magnifying-glass"></i></div>
				</form>
			</div>
		</div>
		<div class="user-list-collumn-indic four-columns">
			<a>email</a>
			<a>role</a>
			<a>edit</a>
			<a>delete</a>
		</div>
		<!-- <h1>search for users</h1> -->
		<div class="user-list-content">
			<div class="user-list-split">searched users</div>
			<div id="user-list" class="user-list">
			</div>
			<div class="user-list-split">all users</div>
			<div id="all-user-list" class="user-list">
			</div>
		</div>
	</div>
</div> 
@endsection


