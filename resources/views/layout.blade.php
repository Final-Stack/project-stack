<!DOCTYPE html>
<html>
<head>
    <title>FinalStack</title>
    <link rel="stylesheet" type="text/css" href="navbar.css">
</head>
<body>
<header>
    <nav id="nav_container">
        <!-- Contenedor con el logo y/o nombre -->
        <a href="/" id="logo_container">
            <img id="logo" src="../../public/img/StackLogo.png">
        </a>

        <!-- Contenedor con el buscador por titulo -->
        <form id="buscador">
            <div>
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="What are you looking for?">
                    <button type="submit" class="searchButton">
                        <img src="../../public/img/magnifying-glass.png">
                    </button>
                </div>
            </div>
        </form>
        <input type="button" name="signIn" value="sign in">
        <input type="button" name="logIn"  value="log in">
    </nav>
    <div id="container">
        @yield('content')
    </div>
</header>
</body>
</html>


