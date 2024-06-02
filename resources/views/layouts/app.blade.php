<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>the shop</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('resources/css/styles.css') }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js']) <!--une expérience de développement rapide et efficace en utilisant la compilation et le serveur de développement rapide-->
    <style>
        body {
            background-image: url('/images/fond de notre site .png');
            background-size: cover; /* Adjust as needed */
            background-repeat: no-repeat;
        }
        .welcome-heading2 {
            font-size: 1.25em;
            color: #0F2649;
            font-weight: bold;
        }
        .welcome-heading4 {
            font-size: 1.5em;
            color: #0F2649;
            font-weight: bold;/*type d'ecriture*/
        }
    </style>
</head>
<body>
    
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #B0C9CD;">
            <div class="container">
                <a class="navbar-brand welcome-heading4" href="{{ url('/') }}">
                   The shop 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"> 

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                <a class="nav-link welcome-heading4" href="{{ route('login') }}">
                              <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                              </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                <a class="nav-link welcome-heading4" href="{{ route('register') }}">
                              <i class="fas fa-user-plus"></i> {{ __('Register') }}
                              </a>
                                </li>
                            @endif
                            @else
                        <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle welcome-heading4" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" style="background-color: #B0C9CD" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item welcome-heading2" style="background-color: #B0C9CD" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
                        </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
