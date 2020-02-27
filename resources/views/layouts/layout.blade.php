<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{config('app.name')}}</title>
    <!-- Jquery popper y Bootstrap-JS  -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- CSS  -->
    <link rel="stylesheet" type="text/css" href="{{secure_asset('css/navbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{secure_asset('css/index.css')}}">
    <link rel="stylesheet" type="text/css" href="{{secure_asset('css/profile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{secure_asset('css/busquedaUsuarios.css')}}">
    <!-- JS  -->
    <script src="{{secure_asset('js/etiquetas.js')}}" ></script>

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

@if(Request::path() != 'login' && Request::path() != 'register' )
    <aside>
        @include('aside.aside')
    </aside>
@endif
<script src="{{ secure_asset('js/tags.js') }}"></script>
<script src="{{ secure_asset('js/profile.js') }}"></script>
<script src="{{ secure_asset('js/navbar.js') }}"></script>
<script src="{{secure_asset('js/comments.js')}}" ></script>
</body>
<!-- Font awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" integrity="sha256-MAgcygDRahs+F/Nk5Vz387whB4kSK9NXlDN3w58LLq0=" crossorigin="anonymous"></script>
<script src="{{secure_asset('js/app.js')}}" ></script>

</html>
