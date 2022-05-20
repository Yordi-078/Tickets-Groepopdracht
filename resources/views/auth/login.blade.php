@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-header">
        <div class="form-header-image"><i class="fas fa-user"></i></div>
        <h1>{{ __('Inloggen') }}</h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

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
            <label for="password"><i class="fas fa-lock"></i></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror form-input" name="password" placeholder="Wachtwoord" required autocomplete="current-password">
        </div>
        
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- remember me -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Onthoud mij') }}
            </label>
        </div>

        <!-- submit and forgot password -->
        <div class="form-submit">
            <button type="submit" class="form-submit-button">
                {{ __('Inloggen') }}
            </button>
            <br>

            @if (Route::has('password.request'))
                <a class="form-bottom-text" href="{{ route('password.request') }}">
                    {{ __('Wachtwoord vergeten?') }}
                </a>
            @endif
        </div>

    </form>
</div>
@endsection
