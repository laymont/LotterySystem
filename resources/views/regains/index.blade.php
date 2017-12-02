@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-10">
      <h3>Retiros Pendientes</h3>
      @if ($regains->isNotEmpty())
      <table class="table table-bordered table-striped">
        <caption>Listado de Retiros Pendientes</caption>
        <thead>
          <tr>
            <th>ID</th>
            <th>Registro</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Monto</th>
            <th>Banco</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($regains as $element)
          <tr>
            <td>{{ $element->id }}</td>
            <td>{{ $element->created_at }}</td>
            <td>{{ $element->date }}</td>
            <td>{{ $element->users->name }}</td>
            <td class="text-right">Bs. {{ number_format($element->amount,2,",",".") }}</td>
            <td>{{ $element->usersinfo->bank->name }}</td>
            <td>
              {!! Form::open(['route'=>['regains.update','regain'=>$element->id],'method'=>'PATCH']) !!}
              {!! Form::hidden('id', $element->id) !!}
              {!! Form::hidden('user_id', $element->users->id) !!}
              {!! Form::hidden('amount', $element->amount) !!}
              {!! Form::submit('Pagar/Reintegrar', ['class'=>'btn btn-sm btn-warning']) !!}
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <h3 class="text-success">No hay reintegro pendientes</h3>
      @endif
    </div>
  </div>
</div>
@endsection