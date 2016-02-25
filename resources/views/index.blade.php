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
            <h1>Gestionlist</h1>
            <h3>Organiza tus ideas...</h3>
            <p>
                Nos ocupamos de como te verán los demás. Creamos para tí un <br />
                <a href="http://keysystemsca.com/planes-web/" target="_blank">Sitio Web</a> acorde a tus necesidades.
                <br><br>
            <a href="{{ url('/proyectos') }}" class="btn btn-outline">Entrar</a><br />
            <br />
            Desarrollado por <a href="http://keysystemsca.com/" target="_blank">Key Systems C.A</a>
        </div>
        <!-- end container -->
    </div>
    <!-- end #home -->
  
</div>	
@endsection
