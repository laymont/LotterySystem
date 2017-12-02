@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-6">
      <h3>Retiros Pendientes</h3>
      <table class="table table-bordered table-striped">
        <caption>Listado de Retiros Pendientes</caption>
        <thead>
          <tr>
            <th>Registro</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($regains as $element)
            <tr>
            <td>{{ $element->created_at }}</td>
            <td>{{ $element->date }}</td>
            <td>{{ $element->name }}</td>
            <td>{{ $element->amount }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection