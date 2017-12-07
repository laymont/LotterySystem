@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <a class="btn btn-sm btn-info float-right" href="{{ url('home') }}" title="Regresar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>&nbsp;
  <div class="row">
    <div class="col-lg-12">
      <h3>Resultados <small>Listado del Dia</small></h3>
      <table id="results" class="table table-bordered table-condensed table-striped datatables">
        <caption>Resultados</caption>
        <thead>
          <tr>
            <th>Date</th>
            <th>Loteria</th>
            <th>Sorteo</th>
            <th>Resultado</th>
          </tr>
        </thead>
        <tbody>
          @foreach($results as $item)
          <tr>
            <td class="text-center align-middle">{{ $item->date }}</td>
            <td class="align-middle">{{ $item->lotterie->name }}</td>
            <td class="text-center align-middle">{{ $translationday->get($item->raffle->day) }} - {{ $item->raffle->hour }}</td>
            <td class="text-center align-middle">
              <img class="img-fluid" width="90px" src="{{ asset('img/animalitos/'.$animals->get($item->result).'.png') }}" alt="{{ $animals->get($item->result) }}" title="{{ $animals->get($item->result) }}">
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    oTable = $('#results').DataTable({
      "order": [[ 0, "desc" ]],
      "pagingType": "full_numbers",
      "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });
  });
</script>
@endsection