@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-8">
      <h3>
        Loterias
        <small>
          <a class="btn btn-sm btn-primary" href="{{ route('lotteries.create') }}" title="Nueva">Crear Loteria</a>
        </small>
      </h3>
      @if ( $lotteries->count() > 0)
      <table id="lottery" class="table table-bordered table-striped datatables">
        <caption>Listado de Loterias</caption>
        <thead>
          <tr>
            <th>Loteria</th>
            <th>Relacion</th>
            <th>Min/Apuesta</th>
            <th>Max/Apuesta</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($lotteries as $item)
          <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->relation }}</td>
            <td class="text-right">{{ number_format($item->min,2,",",".") }}</td>
            <td class="text-right">{{ number_format($item->max,2,",",".") }}</td>
            <td>
              <a class="btn btn-sm btn-info" href="{{ route('raffles.show',['id' => $item->id]) }}" title="Sorteos"> Sorteos</a>
              &nbsp;
              <a class="btn btn-sm btn-warning" href="{{ route('lotteries.edit', ['lottery' => $item->id]) }}" title="Editar">Editar</a>
              &nbsp;
              <button type="button" class="btn btn-secondary btn-sm" disabled>Eliminar</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <div class="alert alert-warning">
        No hay Registros para mostrar
      </div>
      @endif

    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    oTable = $('#lottery').DataTable({
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