@extends('layouts.error')

@section('title', 'Error 404')

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">404</h1>
		<p class="mini-text">Página no encontrada!</p>
		<p class="error-text mb-4 mt-1">Lo que estas buscando no lo encontrras aquí!</p>
		<a href="{{ route('home') }}" class="btn btn-primary mt-5">Volver al Inicio</a>
	</div>
</div>

@endsection