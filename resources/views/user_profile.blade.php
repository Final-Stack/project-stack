@extends('layouts.layout')

@section('content')
<img src="{{$usuario->url_foto}}">
<p>{{$usuario->nombre}}</p>
<p>{{$usuario->email}}</p>
<p>{{$usuario->sector_donde_trabaja}}</p>
<p>{{$usuario->created_at}}</p>
@endsection
