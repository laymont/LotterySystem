@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-6">
      <h3>Abono <small>Recarga</small></h3>
      {!! Form::open(['route' => 'ctausers.store']) !!}

      {!! Form::hidden('user_id', Auth::id()) !!}

      <div class="form-group">
        {!! Form::label('payment_day', 'Fecha de Pago', ['class' => 'control-label']) !!}
        <div class="col-6">
          {!! Form::date('payment_day', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('payment', 'Abono', ['class' => 'control-label']) !!}
        <div class="col-6">
          {!! Form::number('payment', '20000', ['class' => 'form-control text-right', 'placeholder' => 'Monto del Aporte']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('bank_id', 'Banco', ['class' => 'control-label']) !!}
        <div class="col-6">
          {!! Form::select('bank_id', $banks, null, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('type', 'Tipo', ['class' => 'control-label']) !!}
        <div class="col-6">
          {!! Form::select('type', ['Deposito','Transferencia'], 1, ['class' => 'form-control']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('reference', 'Referencia', ['class' => 'control-label']) !!}
        <div class="col-6">
          {!! Form::text('reference', null, ['class' => 'form-control', 'placeholder' => 'Numero de Referencia']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::submit('Abonar', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection