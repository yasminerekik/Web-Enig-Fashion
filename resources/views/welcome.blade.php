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


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('resources/css/styles.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<style>
    body {
        background-image: url('/images/fond de notre site .png');
        background-size: cover; /* Adjust as needed */
        background-repeat: no-repeat;
    }
    .container-fluid {
            margin-top: 5cm;
        }
    .welcome-heading1 {
            font-size: 4.5em;
            color: #0F2649;
            font-weight: bold;
        }
    .welcome-heading2 {
            font-size: 1.25em;
            color: #0F2649;
            font-weight: bold;
        }
        .welcome-heading4 {
            font-size: 1.5em;
            color: #0F2649;
            font-weight: bold;
        }
    .login-message {
            text-align: right;
            margin-top: 0;
        }
</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #B0C9CD;">
            <div class="container">
                <a class="navbar-brand welcome-heading4" href="{{ auth()->check() ? route('home') : url('/') }}">
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
                             @endguest

                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <pre class="welcome-heading4"><p class="container-fluid login-message">Log in please or make a new account ! </p></pre>    
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div>
            <h1 class="welcome-heading1">Welcome to</h1>
                <!-- Ajoutez plus de contenu ici -->
            </div>
        </div>
    </div>
</body>
</html>
