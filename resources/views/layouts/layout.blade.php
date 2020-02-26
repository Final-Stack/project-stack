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
    <link rel="stylesheet" type="text/css" href="{{secure_asset('css/busquedaUsuarios.css')}}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{secure_asset('css/app.css')}}">
</head>
<body>
<header>
    @include('navbar.navbar')
</header>
<div id="container">
    @yield('content')
</div>
<script src="{{ secure_asset('js/tags.js') }}"></script>
</body>
<!-- Jquery popper y Bootstrap-JS  -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{secure_asset('js/app.js')}}" ></script>

</html>
