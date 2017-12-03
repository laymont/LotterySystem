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
  .margin-nav { margin-top: 30px; }
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
    {{-- Start Navbar Bootstrap 4 --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('home') }}">Home <span class="sr-only">(current)</span></a>
          </li>
          @if(Auth::user()->hasRole('admin'))
          <a class="nav-link" href="{{ route('roles.index') }}" title="User&Role">Usuarios y Roles</a>
          <a class="nav-link" href="{{ route('lotteries.index') }}" title="Lotteries">Loterias</a>
          <a class="nav-link" href="{{ route('ctausers.index') }}" title="CtaUsers">Cta/Usuarios</a>
          @endif
        </ul>
        <ul class="navbar-nav">
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
          @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
            <div class="dropdown-menu" aria-labelledby="dropdown08">
              <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
            {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
          </div>
        </li>
        @endguest
      </ul>

    </div>
  </nav>
  {{-- End Navbar Bootstrap 4 --}}
  <div class="container">
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
