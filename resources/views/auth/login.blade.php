@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-header">
        <div class="form-header-image"><i class="fas fa-user"></i></div>
        <h1>{{ __('Login') }}</h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- email -->
        <label for="email" class="">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- password -->
        <label for="password" class="">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- remember me -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <!-- submit and forgot password -->
        <div class="">
            <button type="submit" class="form-submit-button">
                {{ __('Login') }}
            </button>
            <br>

            @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>

    </form>
</div>
@endsection
