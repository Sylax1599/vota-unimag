<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    
    <link rel="stylesheet" href="prueba.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d9674ac41a.js" crossorigin="anonymous"></script>
    @yield('css')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    

</head>
<body>

    <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light" style="background: #004a87;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color: #fff;">
                <img src="https://investigacion.unimagdalena.edu.co/Content/Imagenes/escudo_black.png" alt="" width="40" height="34" class="d-inline-block align-text-center">
                VotaUnimag
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon" ></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" style="color: #fff;" href="{{ route('login') }}">{{ __('Iniciar sesion') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" style="color: #fff;" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                               
                                <a class="nav-link dropdown-toggle" style="color: #fff;" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->nombre }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                   
                                </ul>
                            </li>

                            

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    </div>
    
   
  <!-- Footer -->
    
 
  <div>
        <section class="content">
            @yield('content')
        </section>
  <div>
		
  <div>
        <!-- Footer -->
        <footer class="footer-07">
			<div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                        <div class="logosGeneral">
                            <img id="selloUnimagdalena" src="https://cdn.unimagdalena.edu.co/images/escudo/bg_dark/default.png" alt="escudo de la Universidad del Magdalena">
                            <img id="yearsUnimagdalena" src="https://cdn.unimagdalena.edu.co/images/years_96.png" alt="escudo de los años que tiene la Universidad del Magdalena">
                            <img id="selloAcreditacion" src="https://cdn.unimagdalena.edu.co/images/acreditacion/default-border.png" alt="Marca de acreditación de alta calidad">
                            <img id="selloColombia" src="https://cdn.unimagdalena.edu.co/images/escudo_colombia.png" alt="Escudo de colombia">
                            <img id="sellosCalidad" class="img-responsive" src="https://cdn.unimagdalena.edu.co/images/calidad/bg-dark/default.png" alt="Sellos de calidad">
                        </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 text-center">
                            <p class="copyright">
                                Copyright 2021
                            </p>
                        </div>
                    </div>
			</div>
        </footer>
</div>

    
		
   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
