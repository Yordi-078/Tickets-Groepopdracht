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
                    <div>
                        <a href="{{ url('/home') }}" class="buttons landing-page-buttons">Home</a>
                        <hr class="focus-border">
                    </div>
                    @else
                    <div>
                        <a href="{{ route('login') }}" class="buttons landing-page-buttons">Log-in</a>
                        <hr class="focus-border">
                    </div>
                        @if (Route::has('register'))
                        <div>
                            <a href="{{ route('register') }}" class="buttons landing-page-buttons">Register</a>
                            <hr class="focus-border">
                        </div>
                        @endif
                    @endauth
                @endif
            </div>
        </div>     
    </body>
</html>
