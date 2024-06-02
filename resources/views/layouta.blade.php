<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>the shop </title>

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
        background-image: url('/images/fond de mode connecte.png');
        background-size: cover; /* Adjust as needed */
        background-repeat: repeat-y;
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
    .dropdown {
    position: relative;
    display: inline-block; /*Affiche les éléments comme des éléments en ligne avec la possibilité de définir une largeur et une hauteur*/
  }

  .dropdown-content {
    display: none; /*Masque initialement les éléments .dropdown-content, car leur affichage est défini sur "none"*/
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #B0C9CD;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .btn {
    background-color: #AB792D;
    color: white;
    margin-right: 10px;
    cursor: pointer;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
  }
</style>
</head>
<body>
    
<div id="app">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #B0C9CD;">
            <div class="container">
                <a class="navbar-brand welcome-heading4">
                 The shop
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="seller.home" class="btn btn-primary welcome-heading2" style="background-color: #AB792D; color: white; margin-right: 10px;">
                <i class="fas fa-home welcome-heading2"></i> Home
                </a>
                <div class="dropdown">
                <a href="#" class="btn btn-primary welcome-heading2" style="background-color: #AB792D; color: white; margin-right: 10px;" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-book welcome-heading2"></i> Catalog
                </a>
    <ul class="dropdown-menu"  style="background-color: #B0C9CD" aria-labelledby="navbarDropdownMenuLink">
        <li><a class="dropdown-item welcome-heading2" style="background-color: #B0C9CD" href="{{ route('products.category', ['category' => 'women']) }}">Women</a></li>
        <li><a class="dropdown-item welcome-heading2" style="background-color: #B0C9CD" href="{{ route('products.category', ['category' => 'men']) }}">Men</a></li>
        <li><a class="dropdown-item welcome-heading2" style="background-color: #B0C9CD" href="{{ route('products.category', ['category' => 'kids']) }}">Kids</a></li>
    </ul>
</div>

<a href="seller.contact" class="btn btn-success welcome-heading2" style="background-color: #AB792D; color: white; margin-right: 10px;">
    <i class="fas fa-envelope welcome-heading2"></i> Contact
</a>
@if(auth()->check() && auth()->user()->hasRole('seller'))
<a href="{{ route('seller.dashboard') }}" class="btn btn-secondary welcome-heading2" style="background-color: #AB792D; color: white; margin-right: 10px;">
    <i class="fas fa-book-open welcome-heading2"></i> Seller dashboard
</a>

@endif

<a href="{{ route('order.history') }}" class="btn btn-secondary welcome-heading2" style="background-color: #AB792D; color: white; margin-right: 10px;">
    <i class="fas fa-shopping-cart welcome-heading2"></i> Order History
</a>

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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                        <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle welcome-heading4" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" style="background-color: #B0C9CD" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item welcome-heading2" style="background-color: #B0C9CD" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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