@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-6">
      <h3>Loteria {{ $raffles[0]->lotteries->name }} <small> Sorteos</small></h3>
      <table class="table table-bordered table-striped table-hover">
        <caption>Lista de Sorteos</caption>
        <thead>
          <tr>
            <th>Dia</th>
            <th>Hora</th>
            <th>Limite</th>
          </tr>
        </thead>
        <tbody>
          @foreach($raffles as $item)
          <tr>
            <td>{{ $item->day }}</td>
            <td class="text-center">{{ $item->hour }}</td>
            <td class="text-right">{{ $item->limit }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection