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
  <!-- Styles -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Oswald:400,600" rel="stylesheet">
  <style type="text/css" media="screen">
  body {
    font-family: 'Oswald', sans-serif;
  }
  .bg-dark-custom { background-color: #000; }
  .margin-nav { margin-top: 30px; }
  .text-white { color: white; }

</style>
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

</head>
<body>
  <div id="app">
    {{-- Start Navbar Bootstrap 4 --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

      </div>
    </nav>
    {{-- End Navbar Bootstrap 4 --}}
    <div class="container">
      <div class="row">
        <div class="col-4 offset-4">
         @include('flash::message')
       </div>
     </div>
   </div>
   @yield('content')
 </div>

 <!-- Scripts -->
 <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
 <script src="{{ asset('js/popper.min.js') }}"></script>
 <script src="{{ asset('js/bootstrap.min.js') }}"></script>
 {{-- Another Scripts --}}
 @yield('scripts')
</body>
</html>
