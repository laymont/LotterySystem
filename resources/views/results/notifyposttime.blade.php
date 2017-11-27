@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-6">
      <h3>Resultados <small>Registrar</small></h3>
      {!! Form::open(['route' => 'results.store']) !!}

      <div class="form-group">
        {!! Form::label('date', 'Fecha', ['class' => 'control-label']) !!}
        <div class="col-lg-6">
          <p class="lead">{{ \Carbon\Carbon::now() }}</p>
          {!! Form::hidden('date', \Carbon\Carbon::now()) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('lottery_id', 'Loteria', ['class' => 'control-label']) !!}
        <div class="col-lg-6">
          {!! Form::select('lottery_id', $lottery, 0, ['class' => 'form-control']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('raffle_id', 'Sorteo', ['class' => 'control-label']) !!}
        <div class="col-lg-6">
          {!! Form::select('raffle_id', $raffle, null, ['class' => 'form-control']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('result', 'Resultado', ['class' => 'control-label']) !!}
        <div class="col-lg-6">
          {!! Form::select('result', ['0'=>'Delfin','-1'=>'Ballena','01'=>'Carnero','02'=>'Toro','03'=>'Cienpies','04'=>'Alacran','05'=>'Leon','06'=>'Rana','07'=>'Perico','08'=>'Raton','09'=>'Aguila','10'=>'Tigre','11'=>'Gato','12'=>'Caballo','13'=>'Mono','14'=>'Paloma','15'=>'Zorro','16'=>'Oso','17'=>'Pavo','18'=>'Burro','19'=>'Chivo','20'=>'Cerdo','21'=>'Gallo','22'=>'Camello','23'=>'Cebra','24'=>'Iguana','25'=>'Gallina','26'=>'Vaca','27'=>'Perro','28'=>'Zamuro','29'=>'Elefante','30'=>'Caiman','31'=>'Lapa','32'=>'Ardilla','33'=>'Pescado','34'=>'Venado','35'=>'Jirafa','36'=>'Culebra'], null, ['class' => 'form-control', 'placeholder' => 'Numero Ganador']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::submit('Registrar', ['class' => 'btn btn-success']) !!}
      </div>
      {!! Form::close() !!}
    </div>
    <div class="col-lg-6">
      {{-- Sorteos pendientes por resultado --}}
      @if (!$withoutReport->isEmpty())
      <h4 class="card-title text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> Resultados pendientes por Notificar </h4>
      <table class="table table-bordered">
        <caption>Resultados Pendientes</caption>
        <thead>
          <tr>
            <th>Dia</th>
            <th>Hora</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($withoutReport as $item)
          <tr>
            <td>{{ $item->day }}</td>
            <td>{{ $item->hour }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
</div>
@endsection