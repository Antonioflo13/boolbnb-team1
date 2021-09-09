<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <style>
        footer{
        background-color: #FFFFFF;
        border-top: 1px solid rgb(255, 255, 255);
    
    }
    .ms-footer{
        color: white;
    }
    .ms-list-group{
        list-style: none;
        color: #4A4B4B;
    }
    a{
       text-decoration: none; 
       color: #4A4B4B;
       transition: all 0.2s;
    }
    hover{
        text-decoration:underline;
    }
    .ms-social {
        display: none;
    }
    .fab{
       color: #4A4B4B; 
    }
    
    /* //MediaQuery */
    @media screen and (min-width: 576px){
    .ms-social {
        display: block;
    }
    }
    </style>
</head>
<body>
    <div>
        <nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img class='ms-logo mr-2' src="/images/logo.png" alt="Logo"> 
                    <strong class="ms-text ml-3"> boolbnb </strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    
                    <!-- Center Of Navbar -->
                    <ul class="navbar-nav">
                        @guest
                        @else 
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.inbox') }}">Inbox</a>
                        </li>
                        <li>
                            <a class="nav-link" href="#">Insights</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                               Menu
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.appartments.index') }}">Appartments List</a>
                                <a class="dropdown-item" href="{{ route('admin.appartments.create') }}">Add Appartment</a>
                            </div>
                        </li>
                        @endguest
                    </ul>
         

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        </main>
        <footer>
            <div class="container ms-footer py-3">
                <div class="row">
                    <div class="col">
                        <ul class="d-flex flex-wrap ms-footer-links align-items-center my-2">
                            <li class="ms-list-group mr-3"> &copy; 2021 Boolbnb, Inc. </li> 
                            <li class="ms-list-group mr-3"><a href="#">Privacy</a> </li>
                            <li class="ms-list-group mr-3"><a href="#">Terms</a></li>
                            <li class="ms-list-group mr-3"><a href="#">Sitemap</a></li>
                        </ul>
                    </div>
                    <div class="col ms-social">
                        <ul class="d-flex flex-row-reverse align-items-center my-2">
                            <li class="ms-list-group mr-3"><a href="#"><i class="fab fa-2x fa-instagram"></i></a></li>
                            <li class="ms-list-group mr-3"><a href="#"><i class="fab  fa-2x fa-twitter"></i></a> </li>
                            <li class="ms-list-group mr-3"> <a href="#"><i class="fab fa-2x fa-facebook-f"></i></a></li>   
                        </ul>
    
                    </div>
                </div> 
            </div>
        </footer>
    </div>
</body>
</html>


