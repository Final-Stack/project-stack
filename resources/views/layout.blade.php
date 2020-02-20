<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <!-- CSS  -->
    <link rel="stylesheet" type="text/css" href="{{secure_asset('css/navbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{secure_asset('css/index.css')}}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{secure_asset('css/app.css')}}">
</head>
<body>
<header>
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
                        <img id="logo" src="{{secure_asset('img/magnifying-glass.png')}}">
                    </button>
                </div>
            </div>
        </form>
        <input type="button" name="signIn" value="sign in">
        <input type="button" name="logIn"  value="log in">
    </nav>
</header>
<div id="container">
    @yield('content')
</div>
</body>
<!-- Jquery popper y Bootstrap-JS  -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{secure_asset('js/app.js')}}" ></script>

</html>
