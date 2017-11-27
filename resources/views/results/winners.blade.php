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
          <th>Resultado</th>
          <th>Gano</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($winners as $item)
        <tr>
          <td>{{ $item->date }}</td>
          <td>{{ $item->ticket }}</td>
          <td>{{ $item->code }}</td>
          <td>{{ $item->user_id }}</td>
          <td>{{ $item->lottery_id }}</td>
          <td>{{ $item->resultraffle }}</td>
          <td>{{ $item->result }}</td>
          <td class="text-right">{{ number_format($item->gain,2,",",".") }}</td>
          <td>
            @if ($item->pay == 0)
            {!! Form::open(['route'=>'ctausers.addacount']) !!}
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