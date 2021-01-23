<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'News') }}</title> -->
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- srtipe is for credit card charging -->
    @if(Route::currentRouteName() == 'checkout.index' || Route::currentRouteName() =='checkout.store')
        <script src="https://js.stripe.com/v3/"></script>
        <script src="{{ asset('js/stripe.js') }}" defer></script>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-gray">
            <div class="container">
                <a class="navbar-brand app-name" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @if (auth()->check())
                        @if (auth()->user()->id == 1)
                            <a class="navbar-brand app-name" href="{{ route('admin.index') }}">Administration</a> 
                        @endif
                    @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li  class='btn-hover'>
                            <a class="btn white-text-btn ml-3" href="{{ route('shop.index') }}">SHOP</a>
                        </li>
                        <li  class='btn-hover'>
                            <a class="btn white-text-btn ml-3" href="/">ABOUT</a>
                        </li>
                        @guest
                            
                            <li class="nav-item">
                                <a class="nav-link"  style="color:white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link"  style="color:white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li  class='btn-hover'>
                                <Cart url="{{ route('cart.index') }}" cart-items-quantity=0></Cart>
                            </li>
                            <li class="nav-item dropdown ml-5">
                                <a id="navbarDropdown" style="color:white" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
