<nav id="nav_container">
    <!-- Contenedor con el logo y/o nombre -->
    <a href="{{route('index')}}" id="logo_container">
        <img id="logo" src="{{secure_asset('img/finalstack-logo.png')}}" alt="logo">
    </a>

    <!-- Contenedor con el buscador por titulo -->
    <form id="buscador" action="{{route('index.buscar')}}">
        @csrf
        <div>
            <div class="search">
                <input type="text" class="w-100 pl-4 mt-1 searchTerm" name="buscar">
                <svg id="lupa">
                    <path
                        d="M18 16.5l-5.14-5.18h-.35a7 7 0 1 0-1.19 1.19v.35L16.5 18l1.5-1.5zM12 7A5 5 0 1 1 2 7a5 5 0 0 1 10 0z"></path>
                </svg>

            </div>
        </div>
    </form>

    <img src="{{Storage::url( Auth::user()->url_foto ?? 'upload/transparente.png')}}" id="user_img">
    <input type="hidden" value="{{ Auth::user()->id ?? ''}}" id="user_id">
    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav m-auto  d-flex flex-row">
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
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->nombre }} <span class="caret"></span>
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
</nav>
