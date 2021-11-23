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
    <body class="antialiased">
        <div class="welcome-content-box">
            <div class="headertext">Tick-It</div>
            <div class="stripes">—————— ★ ——————</div>
            <div class="login-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="buttons">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="buttons">Log-in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="buttons">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>     
    </body>
</html>
