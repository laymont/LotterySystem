@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <a class="btn btn-sm btn-info float-right" href="{{ url('home') }}" title="Regresar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>&nbsp;
  <div class="row">
    <div class="col-4 offset-1">
      <h3>Mi Saldo <small class="text-success">Actual</small></h3>
      <div class="card">
        <h4 class="card-header">Saldo</h4>
        <div class="card-body">
          <p class="lead">Disponible <span class="float-right text-success">{{ number_format($balance[0]->amount,2,",",".") }}</span></p>
          <a href="{{ route('ctausers.create') }}" class="btn btn-success"> Abono</a>
          &nbsp;
          <a class="btn btn-primary"  data-toggle="collapse" href="#regain" aria-expanded="false" aria-controls="regain">Retiro</a>
        </div>
        {{-- retiro --}}
        <div class="collapse" id="regain">
          <hr>
            <div class="col-8">
              {!! Form::open(['route' => ['ctausers.regain', Auth::id()], 'method' => 'PATCH'] ) !!}
              {!! Form::hidden('user_id', Auth::id()) !!}
            <div class="form-group">
              {!! Form::number('amount', null, ['class'=>'form-control text-right', 'placeholder'=> 'Monto minimo 10.000,00']) !!}
              <small id="amountHelp" class="form-text text-muted">Indique el Monto a Retirar.</small>
            </div>
            <div class="form-group">
              {!! Form::submit('Retirar', ['class'=>'btn  btn-warning']) !!}
            </div>
            {!! Form::close() !!}
            </div>
            {{-- retiro --}}
          </div>
      </div>
    </div>
    <div class="col-6">
      <h3>Abonos a cuenta <small class="text-info">Historial</small></h3>
      <table class="table table-bordered table-striped table-hover">
        <caption>Abonos</caption>
        <thead>
          <tr>
            <th>Dia</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>
          @foreach($amounts as $item)
          <tr>
            <td class="text-center">{{ $item->payment_day }}</td>
            <td class="text-right">
              @if ( $item->spent == 1) {{-- consumido --}}
              @php
              {{ $spent = $item->payment - ($item->payment * 2); }}
              @endphp
              <span class="text-danger">{{ number_format($spent,2,",",".")  }}</span>
              @else
              @if ($item->confirmed == 0)
              <span class="text-warning"><sup><abbr title="Sin Confirmar">*</abbr></sup>&nbsp;{{ number_format($item->payment,2,",",".")  }}</span>
              @else
              <span class="text-success">{{ number_format($item->payment,2,",",".")  }}</span>
              @endif
              @endif {{-- consumido fin --}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <hr>
      <h3>Retiro <small class="text-info">Historial</small></h3>
      <table class="table table-bordered table-striped table-hover">
        <caption>Retiros</caption>
        <thead>
          <tr>
            <th>Dia</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td class="text-center"></td>
            <td class="text-right"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection