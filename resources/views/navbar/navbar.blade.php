<nav id="nav_container" class="navbar navbar-expand-md navbar-light bg-light shadow">
    <!-- Contenedor con el logo y/o nombre -->
    <a href="{{route('index')}}" id="logo_container" class="navbar-brand mb-0 h1">
        <img id="logo" src="{{secure_asset('img/finalstack-logo.png')}}" alt="logo">
    </a>

    <!-- Contenedor con el buscador por titulo -->
    <form id="buscador" action="{{route('index.buscar')}}">
        @csrf
        <div>
            <div class="search">
                <input type="text" class="w-100 searchTerm" name="buscar">
                <svg id="lupa">
                    <path
                        d="M18 16.5l-5.14-5.18h-.35a7 7 0 1 0-1.19 1.19v.35L16.5 18l1.5-1.5zM12 7A5 5 0 1 1 2 7a5 5 0 0 1 10 0z"></path>
                </svg>
            </div>
        </div>
    </form>

    <!-- Right Side Of Navbar -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{Storage::url( Auth::user()->url_foto)}}" id="user_img"> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <div class="dropdown-item">
                            <a href="{{route('user.profile',['id'=>Auth::user()->id])}}"> Mi
                                perfil {{Auth::user()->nombre}}</a>
                        </div>
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
</nav>
