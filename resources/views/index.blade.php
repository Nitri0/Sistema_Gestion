@extends('base-cliente')

@section('content')

<div id="page-container" class="fade">
    
	@include('layouts/navbar-cliente')

    <!-- begin #home -->
    <div id="home" class="content has-bg home">
        <!-- begin content-bg -->
        <div class="content-bg">
            <img src="{{ url ('/thema/admin/html/assets/img/login-bg/bg-6.jpg') }}" alt="Home" />
        </div>
        <!-- end content-bg -->
        <!-- begin container -->
        <div class="container home-content">
            <h1>Gesti <img src="{{ url('img/logo.png') }}"> list</h1>
            <h3>Organiza tus Ideas...</h3>
            <a href="{{ url('/proyectos') }}" class="btn btn-outline">Entrar</a><br />
            <br />
            Desarrollado por <a href="http://keysystemsca.com/" target="_blank">Key Systems C.A</a>
        </div>
        <!-- end container -->
    </div>
    <!-- end #home -->
  
</div>	
@endsection
