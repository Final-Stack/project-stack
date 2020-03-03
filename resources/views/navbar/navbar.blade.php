<nav id="nav_container" class="navbar navbar-expand-sm navbar-light bg-white shadow fixed-top">
    <!-- Contenedor con el logo y/o nombre -->
    <a class="navbar-brand " href="{{route('index')}}">
        <img id="logo" src="{{secure_asset('img/finalstack-logo.png')}}" alt="logo" class="d-inline-block align-top">
    </a>

    <!-- Contenedor con el buscador por titulo -->
    <form id="buscador" action="{{route('index.buscar')}}" class="form-inline">
        @csrf
        <div class="search w-100 d-flex">
            <input type="text" class="w-100 searchTerm" name="buscar" placeholder="Buscar...">
            <svg id="lupa">
                <path
                    d="M18 16.5l-5.14-5.18h-.35a7 7 0 1 0-1.19 1.19v.35L16.5 18l1.5-1.5zM12 7A5 5 0 1 1 2 7a5 5 0 0 1 10 0z"></path>
            </svg>
        </div>
    </form>
       <!-- Right Side Of Navbar -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse bg-white" id="navbarNav">
        <div class="nav-item m-md-3 m-sm-0 col-6">
            <a id="user_search" class="btn btn-warning text-nowrap" href="{{route('users')}}">
                Buscar usuarios
            </a>
        </div>
        <ul id="user_actions" class="navbar-nav col-6">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-nowrap" href="{{ route('login') }}">{{ __('nombres.login') }}</a>
                </li>
                @if (Route::has('register'))

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('nombres.register') }}</a>

                    </li>
                @endif
            @else
                <li class="nav-item dropdown menu ">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        @if(Auth::user()->google_id == null)
                            <img src="{{secure_asset( Auth::user()->url_foto)}}" id="profile_img"
                                 class="border rounded-circle">
                        @else
                            <img src="{{ Auth::user()->url_foto}}" id="profile_img" class="border rounded-circle">
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-right col-sm-3" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item"
                           href="{{route('user.profile',['id'=>Auth::user()->id])}}"> Mi
                            perfil <span class="text-capitalize"> {{Auth::user()->nombre}}</span>
                        </a>
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
