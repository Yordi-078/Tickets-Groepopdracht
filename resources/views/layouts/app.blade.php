<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('css/images/logo.png') }}" type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}" defer></script>
    @yield('second_script')
    @yield('calendar_script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/66499e4192.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @routes
</head>
<body>

    <div id="app">
        <nav class="app-navbar">
            <a class="app-navbar-title" href="{{ url('/') }}">Tick-It</a>
            @guest
            
            @else
                <a class="app-navbar-item" href="{{ url('home') }}"><i class="fa fa-house"></i></a>
            @endguest
            <div class="app-navbar-user-info">
                <button class="app-navbar-dropdown-button"></button>
                <div class="app-navbar-dropdown-content">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Inloggen') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registreren') }}</a>
                        @endif
                    @else
                        <a id="" class="" href="{{ route('viewUserPage', Auth::user()->id) }} ">
                            {{ Auth::user()->name }}
                        </a>
                        @if (Auth::user()->user_role_id == 3 )
                            <a class="dropdown-item" href="{{ route('changeUserRoles') }}">
                                {{ __('Gebruikersrollen wijzigen') }}
                            </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Uitloggen') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                </div>    
            </div>

        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
