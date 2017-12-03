<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  {{-- Sweet Alert --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('js/src/sweetalert.css') }}">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Spectral+SC" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=EB+Garamond" rel="stylesheet">
  <style type="text/css" media="screen">
  html, body {
    font-family: 'EB Garamond', serif;
  }
  h1,h2,h3,h4,h5,h6 {
    font-family: 'Spectral SC', serif;
    color: #3E4377;
  }
  .card-header { color: #616161; background-color: #E3F3F7; }
  .bg-dark-custom { background-color: #000; }
  .margin-nav { margin-top: 60px; }
  .text-white { color: white; }
  table tr td { font-family: 'Open Sans', sans-serif; color: #4A2C2C; font-size: 0.8em !important; }
  table thead th { color: #616161; background-color: #E3F3F7; }
  .list-group a:hover { color: #3E4377; }

</style>
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>

@yield('csss')

</head>
<body>
  <div id="app">
    {{-- New NavBar --}}
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          @guest
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('home') }}">Inicio/App <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
          @else
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('home') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio/App <span class="sr-only">(current)</span></a>
          </li>
          @if(Auth::user()->hasRole('admin'))
          <li>
            <a class="nav-link" href="{{ route('roles.index') }}" title="User&Role"><i class="fa fa-users" aria-hidden="true"></i> Usuarios y Roles</a>
          </li>
          <li>
            <a class="nav-link" href="{{ route('lotteries.index') }}" title="Lotteries">Loterias</a>
          </li>
          <li>
            <a class="nav-link" href="{{ route('ctausers.index') }}" title="CtaUsers"><i class="fa fa-users" aria-hidden="true"></i> Cta/Usuarios</a>
          </li>
          @endif
          @endguest
        </ul>
        @auth
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> {{ auth()->user()->name }}</a>
            <div class="dropdown-menu" aria-labelledby="dropdown03">
              {{-- <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a> --}}
              <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <span class="text-danger"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </div>
        </li>
      </ul>
      @endauth
    </div>
  </nav>
  {{-- New NavBar --}}
  <div class="container margin-nav">
    @include('sweet::alert')
    <div class="row">
      <div class="col-4 offset-4">
       {{-- @include('flash::message') --}}
     </div>
   </div>
 </div>
 @yield('content')
</div>

<!-- Scripts -->

<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/chart.min.js') }}"></script>


<script>
  // $('#flash-overlay-modal').modal();
</script>
{{-- Another Scripts --}}
@yield('scripts')

</body>
</html>
