@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-8">
      <h3>Loterias <small>Crear</small></h3>

      {!! Form::model($lotterie, ['route' => ['lotteries.store', $lotterie->id]]) !!}

      <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Loteria', ['class' => 'control-label']) !!}
        <div class="col-md-6">
          {!! Form::text('name', $lotterie->name, ['class' => 'form-control', 'placeholder' => 'Nombre de la Loteria']) !!}
          @if ($errors->has('email'))
          <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
          @endif
        </div>
      </div>

      <div class="form-group {{ $errors->has('relation') ? 'has-error' : ''  }}">
        {!! Form::label('relation', 'Relacion', ['class' => 'control-label']) !!}
        <div class="col-md-6">
          {!! Form::text('relation', $lotterie->relation, ['class' => 'form-control', 'placeholder' => 'Relación de Ganancia/Cliente']) !!}
          @if ($errors->has('relation'))
          <span class="help-block"><strong>{{ $errors->first('relation') }}</strong></span>
          @endif
        </div>
      </div>

      <div class="form-group {{ $errors->has('min') ? 'has-error' : ''  }}">
        {!! Form::label('min', 'Min', ['class' => 'control-label']) !!}
        <div class="col-md-6">
          {!! Form::number('min', $lotterie->min, ['class' => 'form-control', 'placeholder' => 'Cantidad minima de Apuesta']) !!}
          @if ($errors->has('min'))
          <span class="help-block"><strong>{{ $errors->first('min') }}</strong></span>
          @endif
        </div>
      </div>

      <div class="form-group {{ $errors->has('max') ? 'has-error' : ''  }}">
        {!! Form::label('max', 'Max', ['class' => 'control-label']) !!}
        <div class="col-md-6">
          {!! Form::number('max', $lotterie->max, ['class' => 'form-control', 'placeholder' => 'Cantidad minima de Apuesta']) !!}
          @if ($errors->has('max'))
          <span class="help-block"><strong>{{ $errors->first('max') }}</strong></span>
          @endif
        </div>
      </div>

      <div class="form-group">
        {!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
      </div>

      {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection