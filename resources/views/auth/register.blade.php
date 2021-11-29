@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="form-header">
        <div class="form-header-image"><i class="fas fa-user"></i></div>
        <h1>{{ __('Register') }}</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- name -->
        <label for="name" class="">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <!-- email -->
        <label for="email" class="">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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

        <!-- confirm password -->
        <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">


        <!-- submit and forgot password -->
        <div class="">
            <button type="submit" class="form-submit-button">
                {{ __('Register') }}
            </button>
            <br>
        </div>

    </form>
</div>
@endsection
