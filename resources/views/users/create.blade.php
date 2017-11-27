@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row margin-nav">
    <div class="col-4">
      <div class="card">
        <h4 class="card-header">Informacion</h4>
        <div class="card-body">
          <p class="card-title">
            <span class="text-muted">Usuario:</span> {{ Auth::user()->name }}
            <br>
            <span class="text-muted">Email:</span> {{ Auth::user()->email }}
          </p>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <h4 class="card-header">Extra</h4>
        <div class="card-body">
          {!! Form::open(['route'=> 'users.store', 'class' => 'form-horizontal']) !!}
          {!! Form::hidden('user_id', Auth::user()->id) !!}

          <div class="form-group">
            {!! Form::label('address', 'Dirección', ['class' => 'control-label']) !!}
            <div class="col-6">
              {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Dirección de Habitación o Trabajo','size' => '10x2']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('phone', 'Teléfono', ['class' => 'control-label']) !!}
            <div class="col-6">
              {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Numero de Teléfono 0000 000 00 00 ']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('bank_id', 'Banco', ['class' => 'control-label']) !!}
            <div class="col-6">
              {!! Form::select('bank_id', $banks, null, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('accout', 'Cuenta Nº', ['class' => 'control-label']) !!}
            <div class="col-6">
              {!! Form::text('account', null, ['class' => 'form-control', 'placeholder' => 'Indique su Numero de cuenta']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('credit_card', 'Posee Tarjeta de Credido', ['class' => 'control-label']) !!}
            {!! Form::checkbox('credit_card', 'Y') !!}
            <div class="col-6">
              {!! Form::label('cc_type', 'Tipo/CC', ['class' => 'control-label']) !!}
              {!! Form::select('cc_type', ['None'=>'None','Visa'=>'Visa','MasterCard'=>'MasterCard','AmericaExpress'=>'AmericaExpress','Other'=>'Other'], 'None', ['class' => 'form-control', 'disabled']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(function(){
    $('#credit_card').click(function(){
      console.log('click');
      $('#cc_type').prop('disabled', false);
    });
  });
</script>
@endsection