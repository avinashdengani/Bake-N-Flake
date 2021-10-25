<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top bg-skin">
    <div class="container">
        <a class="my-navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo/logo.jpg') }}" alt="company-logo" width="40px" height="52px" class="m-0 p-0 " id="logo-img"> BAKE N FLAKE
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item mr-4 mt-2">
                        <a class="nav-link p-0 m-0 @if (request()->is('cart'))
                            text-dark
                            @else
                            text-muted
                        @endif " href="{{ route('cart.index') }}">Cart <i class="fa fa-shopping-cart"></i></a>
                    </li>

                    <li class="nav-item mr-4 mt-2">
                        <a class="nav-link p-0 m-0 @if (request()->is('your-orders'))
                            text-dark
                            @else
                            text-muted
                        @endif " href="{{ route('your-order') }}">Your Orders</a>
                    </li>
                    @if (!auth()->user()->isAdmin())
                    <li class="nav-item mr-4 mt-2">
                        <a class="nav-link p-0 m-0 @if (request()->is('testmonials/create'))
                            text-dark
                            @else
                            text-muted
                        @endif " href="{{ route('testimonials.create') }}">Rate Us</a>
                    </li>
                    @endif
                    @if (auth()->user()->isAdmin())
                        <li class="nav-item mr-4 mt-2">
                            <a class="nav-link p-0 m-0 @if (request()->is('products/index'))
                                text-dark
                                @else
                                text-muted
                            @endif " href="{{ route('products.index') }}">Admin Panel</a>
                        </li>

                    @endif
                @endauth
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login') && !(request()->is('login')))
                        <li class="nav-item mr-4">
                            <a class="btn my-login-button" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register') && !(request()->is('register')))
                        <li class="nav-item mr-4">
                            <a class="btn my-register-button" href="{{ route('register') }}">{{ __('Register') }}</a>
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
