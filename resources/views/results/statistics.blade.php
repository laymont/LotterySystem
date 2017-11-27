@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <a class="btn btn-sm btn-info float-right" href="{{ url('home') }}" title="Regresar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>&nbsp;
  <div class="row">
    <div class="col-lg-6">
      <h3>Estadisticas</h3>
    </div>
  </div>
  {{-- Graficos --}}
  <div class="row">
    <div class="col-lg-6">
      <h4>Numero con Mas Apariciones</h4>
      <div>
        {!! $chartjs->render() !!}
      </div>
    </div>
    <div class="col-lg-6">
      <h4>Numero con Mas Apariciones</h4>
      <div>
        {!! $chartjsPlay->render() !!}
      </div>
    </div>

  </div>
</div>
@endsection