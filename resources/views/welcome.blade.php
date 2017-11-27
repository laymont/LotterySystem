<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Mundo Animalitos</title>

  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
  <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">

  <!-- Styles -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Oswald:400,600" rel="stylesheet">
  <style type="text/css" media="screen">
  body {
    font-family: 'Oswald', sans-serif;
  }
  .bg-dark-custom { background-color: #000; }
  .bg-personal-theme { background-color: #FF006C; }
  .margin-nav { margin-top: 80px; }
  .jumbotron { color: #F1F2F3; background-color: #3E4377; }
  .img-ruleta {
    background-image: url({{ asset('img/winners1.jpg') }});
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    min-height: 520px;
  }
</style>
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Scripts -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/holder.min.js') }}"></script>
<script src="{{ asset('js/chart.min.js') }}"></script>


</head>
<body>
  {{-- Start Navbar Bootstrap 4 --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-personal-theme fixed-top">
    <a class="navbar-brand" href="{{ url('/') }}"><img class="img-fluid" src="{{ asset('img/text-logo.png') }}" alt="MA"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
          {{-- <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li> --}}
        </ul>
        <ul class="navbar-nav">
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Acceso</a>
          </li>
          <li class="nav-item">
            {{-- <a class="nav-link" href="{{ route('register') }}">Registro</a> --}}
          </li>
          @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</a>
            <div class="dropdown-menu" aria-labelledby="dropdown08">
              <a class="nav-link" href="{{ url('/home') }}">Aplicación</a>
              <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
            {{-- <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a> --}}
          </div>
        </li>
        {{-- Sweet Alert --}}
        <script type="text/javascript">
          swal({
            title: 'Mundo Animalitos',
            type: 'warning',
            html: $('<div>')
            .addClass('some-class')
            .text('Aun permanece activa la aplicación para jugar.'),
            animation: false,
            customClass: 'animated tada'
          });
        </script>
        {{-- Sweet Alert --}}
        @endguest
      </ul>

    </div>
  </nav>
  {{-- End Navbar Bootstrap 4 --}}


  <div class="container-fluid">

    <div class="row justify-content-center img-ruleta">
      <div class="align-self-end margin-nav">
        <img class="img-fluid mx-auto d-block align-bottom" src="{{ asset('img/ruleta.png') }}" alt="">
      </div>
    </div>

    <div class="jumbotron" style="margin-top: 20px;">
      <div class="container">
        <h1 class="display-3">Mundo Animalitos!</h1>
        <p class="lead">Ponemos a su disposicion nuestro sistema de juego en linea, para que se divierta apostando con el juego del momento. Que nos diferencias de las otras paginas de juegos, <span style="color: #FD367E;">nuestro monto limite de apuesta...</span></p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Conoce mas de Nosotros &raquo;</a></p>
      </div>
    </div>

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row">
      <div class="col-md-7 align-self-center">
        <h2 style="color: #FD367E;"> Desde la comodidad de tu hogar.. <span class="text-muted">Jugamos?..</span></h2>
        <p class="lead" style="color: #3E4377;">No tienes porque hacer largas colas para poder hacer tus jugadas en la Ruleta, desde la comidad de tu hogar; desde la PC, Tablet o Teléfono Inteligente podras hacer tus jugadas.</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" src="{{ asset('img/playhome1.jpg') }}" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row">
      <div class="col-md-7 order-md-2 align-self-center">
        <h2 style="color: #3E4377;">Estadisticas.. <span class="text-muted">Tendencias..</span></h2>
        <p class="lead">Nuestro sistema ofrece estadisticas de forma automatizada, basada en las jugadas del momento..</p>
      </div>
      <div class="col-md-5 order-md-1">
        <h4>Animalitos mas Ganadores <small>Lotto Activo</small></h4>
        <div>
          {!! $chartjsPlay->render() !!}
        </div>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row">
      <div class="col-md-7 align-self-center">
        <h2 style="color: #FD367E;"> Apuesta y Cobra.. <span class="text-muted">Facil y Sencillo..</span></h2>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla aliquam explicabo facilis ipsa temporibus laborum dolorum expedita ratione, perspiciatis fugiat?.</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" src="{{ asset('img/efectivo.jpg') }}" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->


    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Regresar arriba</a>
        </p>
        <p>&copy; Company 2017</p>
      </div>
    </footer>

  </body>
  </html>
