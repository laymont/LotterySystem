@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h3>Usuarios y Cuentas</h3>
      <table id="users" class="table table-bordered table-striped table-hover datatables">
        <caption>Listado</caption>
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Fecha/Abono</th>
            <th>Monto/Abono</th>
            <th>Banco/Origen</th>
            <th>Confirmado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($ctausers as $item)
          <tr>
            <td>{{ $item->user->name }}</td>
            <td class="text-center">{{ $item->payment_day }}</td>
            <td class="text-right">
              @if ($item->spent == 0)
              Bs. {{ number_format($item->payment,2,",",".") }}
              <sup>
                <span class="text-primary" title="Con Saldo"><i class="fa fa-battery-full" aria-hidden="true"></i></span>
              </sup>
              @else
              <del>Bs. {{ number_format($item->payment,2,",",".") }}</del>
              <sup>
                <span class="text-danger" title="Sin Saldo"><i class="fa fa-battery-empty" aria-hidden="true"></i></span>
              </sup>
              @endif
            </td>
            <td>{{ $item->bank->name }} ({{ $item->type }}) <br>Ref: {{ $item->reference }}</td>
            <td class="text-center">
              @if ($item->confirmed == 1)
              <span class="text-success"><i class="fa fa-check-square-o" aria-hidden="true"></i></span>
              @else
              <span class="text-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
              @endif
            </td>
            <td>
              <a class="btn btn-sm btn-success" href="#" title="Confirmar"> Confirmar</a>
              &nbsp;
              <a class="btn btn-sm btn-warning" href="#" title="Limitar"> Limitar</a>
              &nbsp;
              <a class="btn btn-sm btn-warning" href="#" title="Suspender"> Suspender</a>
              &nbsp;
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
    oTable = $('#users').DataTable({
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