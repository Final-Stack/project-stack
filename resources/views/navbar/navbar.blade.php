<nav id="nav_container">
    <!-- Contenedor con el logo y/o nombre -->
    <a href="/" id="logo_container">
        <img id="logo" src="{{secure_asset('img/StackLogo.png')}}">
    </a>

    <!-- Contenedor con el buscador por titulo -->
    <form id="buscador">
        <div>
            <div class="search">
                <input type="text" class="searchTerm" placeholder="What are you looking for?">
                <button type="submit" class="searchButton">
                    <img id="lupa" src="{{secure_asset('img/magnifying-glass.png')}}">
                </button>
                <div id="registerlogin">
                    <button type="submit" class="btn" name="signIn" value="sign in" formaction="/login">sign in</button>
                    <button type="submit" class="btn" name="logIn"  value="log in" formaction="/register">log in</button>
                </div>
            </div>
        </div>
    </form>
    <a class="btn btn-outline-primary" href="{{route('login')}}"> Iniciar sesión</a>
    <a class="btn btn-outline-primary" href="{{route('register')}}"> Resgistrarse</a>
</nav>
