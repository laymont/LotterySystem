@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
      <h3>Tickets Jugando <small>Hoy</small></h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <table class="table table-bordered table-striped table-
      ">
        <caption>Listado</caption>
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Ticket</th>
            <th>User ID</th>
            <th>Loteria</th>
            <th>Sorteo</th>
            <th>Numero/Jugada</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tickets as $item)
          <tr>
            <td class="align-middle">{{ $item->date }}</td>
            <td class="text-center align-middle">{{ $item->ticket }}</td>
            <td class="text-center align-middle">{{ $item->user_id }}</td>
            <td class="text-center align-middle">{{ $item->hour }}</td>
            <td class="align-middle">{{ $item->lottery }}</td>
            <td class="text-center align-middle">
              <img class="img-fluid" width="90px" src="{{ asset('img/animalitos/'.$animals->get($item->number).'.png') }}" alt="{{ $animals->get($item->number) }}" title="{{ $animals->get($item->number) }}">
            </td>
            <td class="text-center align-middle">Bs. {{ number_format($item->amount,2,",",".") }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection