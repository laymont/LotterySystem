@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h3>Usuarios y Roles</h3>
      <table id="roles" class="table table-striped table-bordered datatables">
        <caption>Lista de Usuarios</caption>
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($role_user as $item)
          <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->roles[0]->name }}</td>
            <td>
              @if(Auth::user()->hasRole('admin'))
              {{-- set admin --}}
              {!! Form::open(['route'=>['roles.update',$item->id],'method'=>'PATCH']) !!}
              <div class="form-group">
                {!! Form::hidden('user_id', $item->id) !!}
                {!! Form::hidden('role_id', 2) !!}
                {{ Form::button('<i class="fa fa-user-secret" aria-hidden="true"></i> Set Admin', ['type' => 'submit', 'class' => 'btn btn-sm btn-primary']) }}
              </div>
              {!! Form::close() !!}

              {{-- Ser user --}}
              {!! Form::open(['route'=>['roles.update',$item->id],'method'=>'PATCH']) !!}
              <div class="form-group">
                {!! Form::hidden('user_id', $item->id) !!}
                {!! Form::hidden('role_id', 1) !!}
                {{ Form::button('<i class="fa fa-user" aria-hidden="true"></i> Set Usuario', ['type' => 'submit', 'class' => 'btn btn-sm btn-warning']) }}
              </div>
              {!! Form::close() !!}
              @endif
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
    oTable = $('#roles').DataTable({
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