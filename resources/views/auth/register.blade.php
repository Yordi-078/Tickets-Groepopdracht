@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-header">
        <div class="form-header-image"><i class="fas fa-user"></i></div>
        <h1>{{ __('Registreren') }}</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- name -->
        <div class="form-input-container">
            <label for="email"><i class="fas fa-user"></i></label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror form-input" name="name" value="{{ old('name') }}" placeholder="Naam" required autocomplete="name" autofocus>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- email -->
        <div class="form-input-container">
            <label for="email"><i class="fas fa-envelope"></i></label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form-input" name="email" value="{{ old('email') }}" placeholder="E-mailadres" required autocomplete="email">
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- password -->
        <div class="form-input-container">
            <label for="email"><i class="fas fa-lock"></i></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror form-input" name="password" placeholder="Wachtwoord" required autocomplete="current-password">
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- confirm password -->
        <div class="form-input-container">
            <label for="email"><i class="fas fa-lock"></i></label>
            <input id="password-confirm" type="password" class="form-control form-input" name="password_confirmation" placeholder="Wachtwoord bevestigen" required autocomplete="new-password">
        </div>

        <!-- submit and forgot password -->
        <div class="form-submit">
            <button type="submit" class="form-submit-button">
                {{ __('Registreren') }}
            </button>
            <br>
        </div>

    </form>
</div>
@endsection
