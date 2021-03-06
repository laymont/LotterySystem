@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="col-lg-12">
    <h3>Ganadores del Dia</h3>
    <table class="table table-bordered table-striped">
      <caption>Ganadores</caption>
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Ticket</th>
          <th>Codigo</th>
          <th>Usuario</th>
          <th>Loteria</th>
          <th>Sorteo</th>
          <th>Monto</th>
          <th>Resultado</th>
          <th>Gano</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($winners as $item)
        <tr>
          <td class="text-center align-middle">{{ $item->date }}</td>
          <td class="text-center align-middle">{{ $item->ticket }}</td>
          <td class="text-center align-middle">{{ $item->code }}</td>
          <td class="text-center align-middle">{{ $item->user_id }}</td>
          <td class="text-center align-middle">{{ $item->lottery_id }}</td>
          <td class="text-center align-middle">{{ $item->resultraffle }}</td>
          <td class="text-right align-middle">Bs. {{ number_format($item->amount,2,",",".") }}</td>
          <td  class="text-center align-middle">
            <img class="img-fluid" width="90px" src="{{ asset('img/animalitos/'.$animals->get($item->result).'.png') }}" alt="{{ $animals->get($item->result) }}" title="{{ $animals->get($item->result) }}">
          </td>
          <td class="text-right align-middle">Bs. {{ number_format($item->gain,2,",",".") }}</td>
          <td class="align-middle">
            @if ($item->pay == 0)
            {!! Form::open(['route' => ['ctausers.addacount', $item->user_id], 'method' => 'GET']) !!}
            {!! Form::hidden('user_id', $item->user_id) !!}
            {!! Form::hidden('code', $item->code) !!}
            {!! Form::hidden('amount', $item->gain) !!}
            {!! Form::submit('Pagar', ['class' => 'btn btn-sm btn-success']) !!}
            {!! Form::close() !!}
            @else
            <span>Pago/Abonado a Cta.</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection