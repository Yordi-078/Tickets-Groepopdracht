<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

    </head>
    <body>
        <div class="welcome-content-box">
            <h1 class="welcome-header-text">Tick-It</h1>
            <div class="welcome-header-line"><hr>★<hr></div>
            <div class="welcome-login-buttons">
                @if (Route::has('login'))
                    @auth
                    <div>
                        <a href="{{ url('/home') }}" class="welcome-button">Home</a>
                        <hr class="welcome-button-line">
                    </div>
                @else
                    <div>
                        <a href="{{ route('login') }}" class="welcome-button">Inloggen</a>
                        <hr class="welcome-button-line">
                    </div>
                        @if (Route::has('register'))
                        <div>
                            <a href="{{ route('register') }}" class="welcome-button">Registreren</a>
                            <hr class="welcome-button-line">
                        </div>
                        @endif
                    @endauth
                @endif
            </div>
        </div>     
    </body>
</html>
