@extends('layouts.app')

@section('content')
<div class="container-fluid">

  <div class="row">
    <div class="col-3">
      <h3>{{ auth()->user()->name }} <small class="text-muted">Info</small></h3>
      <a class="btn btn-sm btn-info" href="{{ url('home') }}" title="Regresar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>&nbsp;
      <a class="btn btn-sm btn-warning" href="{{ route('users.edit',['id'=>Auth::user()->id]) }}" title="Editar"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
      <hr>
      {{-- Informacion de saldo --}}
      <div class="card">
        <h6 class="card-header">Saldo</h6>
        <div class="card-body">
          <p class="card-title">Disponible en Cta. Mundo Animalitos</p>
          <p class="card-subtitle">
            @if ($balance->isEmpty())
              Saldo Actual: Bs. {{ number_format(0,2,",",".") }}
            @else
            Saldo Actual: Bs. {{ number_format($balance[0]->amount,2,",",".") }}
            @endif
          </p>
          <a href="{{ route('ctausers.create') }}" class="btn btn-success btn-sm"> Abono</a>
          {{-- retiro --}}
          @isset ($balance->amount)
              <a class="btn btn-primary btn-sm"  data-toggle="collapse" href="#regain" aria-expanded="false" aria-controls="regain">Retiro</a>
          @endisset

          <div class="collapse" id="regain">
            <hr>
            @isset ($balance->amount)
            {!! Form::open() !!}
            <div class="form-group">
              {!! Form::number('amount', null, ['class'=>'form-control text-right', 'placeholder'=> 'Monto a Retirar']) !!}
              <small id="amountHelp" class="form-text text-muted">Indique el Monto a Retirar.</small>
            </div>
            <div class="form-group">
              {!! Form::submit('retirar', ['class'=>'btn  btn-warning']) !!}
            </div>
            {!! Form::close() !!}
            @endisset
            {{-- retiro --}}
          </div>

        </div>

      </div>
    </div>
    <div class="col-9">
      <table class="table table-bordered">
        <caption>Información del Usuario</caption>
        <tr>
          <th>Nombre</th>
          <td>{{ $info[0]->user->name }}</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>{{ $info[0]->user->email }}</td>
        </tr>
        <tr>
          <th>Dirección</th>
          <td>{{ $info[0]->address }}</td>
        </tr>
        <tr>
          <th>Teléfono</th>
          <td>{{ $info[0]->phone }}</td>
        </tr>
        <tr>
          <th>Banco</th>
          <td>{{ $info[0]->bank->name }}</td>
        </tr>
        <tr>
          <th>Cuenta</th>
          <td>{{ substr($info[0]->account,0,4) }}-{{ substr($info[0]->account,4,4) }}-{{ substr($info[0]->account,8,2) }}-{{ substr($info[0]->account,10,10) }}</td>
        </tr>
        <tr>
          <th>CC</th>
          <td>{{ $info[0]->credit_card }}</td>
        </tr>
        <tr>
          <th>CC/Tipo</th>
          <td>{{ $info[0]->cc_type }}</td>
        </tr>
      </tr>
    </table>
  </div>
</div>
</div>
@endsection