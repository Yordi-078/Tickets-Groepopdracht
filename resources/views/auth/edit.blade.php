@extends('layouts.app')
@section('second_script')
	<script src="{{ asset('js/editUser.js') }}" defer></script>
@endsection
@section('content')
<div class="form-container">
    <form enctype="multipart/form-data" id="edit-user-form">
        @csrf

        <!-- profile image -->
        <div class="edit-user-form-header">
            <div class="form-header-image" id="user-image"><img id="edit-uploaded-card-image" width="87"/></div>
            <input type="file" name="image" placeholder="Choose image" id="card-upload-image" onchange="loadImage(event)" accept=".gif,.jpg,.jpeg,.png">
            <a class="delete-card-image-button" id="deleteImage">verwijder</a>
        </div>

        <!-- name -->
        <div class="form-input-container">
            <label for="name"><i class="fas fa-user"></i></label>
            <input id="name" type="name" class="form-control form-input" name="name" value="{{ old('name') }}" placeholder="Naam" autofocus>
        </div>

        <!-- email -->
        <div class="form-input-container">
            <label for="email"><i class="fas fa-user"></i></label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form-input" name="email" value="{{ old('email') }}" placeholder="E-mailadres" required autocomplete="email" autofocus>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- password -->
        <div class="form-input-container">
            <label for="password"><i class="fas fa-user"></i></label>
            <input id="password" type="password" class="form-control form-input" name="password" placeholder="wachtwoord" autofocus>
        </div>

        <div>
            <input type="submit" id="Submit-changes-button">
        </div>

    </form>
</div>

@endsection