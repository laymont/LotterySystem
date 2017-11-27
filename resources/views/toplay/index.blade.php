@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6 alert alert-info">
      <p>Hola {{ Auth::user()->name }} quieres Jugar en este momento? <br>Puedes probar mirando nuestras estadisticas, o prefieres saber cuales son los numeros mas jugados ahora?</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h3>Jugar</h3>
      <a class="btn btn-sm btn-info" href="{{ url('home') }}" title="Regresar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-11 offset-lg-1">
      <table class="table table-condensed table-bordered" id="playing">
        <tr class="text-center text-white">
          <td class="bg-danger" data-value="03" data-name="Cienpies" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=03 Cienpies&bg=DC3545" src="{{ asset('img/animalitos/03-Ciempies.png') }}" alt="03 Cienpies">
          </td>
          <td class="bg-dark" data-value="06" data-name="Rana" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=06 Rana&bg=343A40" src="{{ asset('img/animalitos/06-Rana.png') }}" alt="06 Rana">
          </td>
          <td class="bg-danger" data-value="09" data-name="Aguila" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=09 Aguila&bg=DC3545" src="{{ asset('img/animalitos/09-Aguila.png') }}" alt="09 Aguila">
          </td>
          <td class="bg-danger" data-value="12" data-name="Caballo" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=12 Caballo&bg=DC3545" src="{{ asset('img/animalitos/12-Caballo.png') }}" alt="12 Caballo">
          </td>
          <td class="bg-dark"  data-value="15" data-name="Zorro" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=15 Zorro&bg=343A40" src="{{ asset('img/animalitos/15-Zorro.png') }}" alt="15 Zorro">
          </td>
          <td class="bg-danger"  data-value="18" data-name="Burro" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=18 Burro&bg=DC3545" src="{{ asset('img/animalitos/18-Burro.png') }}" alt="18 Burro">
          </td>
          <td class="bg-danger" data-value="21" data-name="Gallo" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=21 Gallo&bg=DC3545" src="{{ asset('img/animalitos/21-Gallo.png') }}" alt="21 Gallo">
          </td>
          <td class="bg-dark" data-value="24" data-name="Iguana" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=24 Iguana&bg=343A40" src="{{ asset('img/animalitos/24-Iguana.png') }}" alt="24 Iguana">
          </td>
          <td class="bg-danger" data-value="27" data-name="Perro" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=27 Perro&bg=DC3545" src="{{ asset('img/animalitos/27-Perro.png') }}" alt="27 Perro">
          </td>
          <td class="bg-danger" data-value="30" data-name="Caiman" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=30 Caiman&bg=DC3545" src="{{ asset('img/animalitos/30-Caiman.png') }}" alt="30 Caiman">
          </td>
          <td class="bg-dark" data-value="33" data-name="Pescado" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=33 Pescado&bg=343A40" src="{{ asset('img/animalitos/33-Pescado.png') }}" alt="33 Pescado">
          </td>
          <td class="bg-danger" data-value="36" data-name="Culebra" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=36 Culebra&bg=DC3545" src="{{ asset('img/animalitos/36-Culebra.png') }}" alt="36 Culebra">
          </td>
        </tr>
        <tr class="text-center text-white">
          <td class="bg-dark" data-value="02" data-name="Toro" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=02 Toro&bg=343A40" src="{{ asset('img/animalitos/02-Toro.png') }}" alt="02 Toro">
          </td>
          <td class="bg-danger" data-value="05" data-name="Leon" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=05 Leon&bg=DC3545" src="{{ asset('img/animalitos/05-Leon.png') }}" alt="05 Leon">
          </td>
          <td class="bg-dark"  data-value="08" data-name="Raton" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=08 Raton&bg=343A40" src="{{ asset('img/animalitos/08-Raton.png') }}" alt="08 Raton">
          </td>
          <td class="bg-dark"  data-value="11" data-name="Gato" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=11 Gato&bg=343A40" src="{{ asset('img/animalitos/11-Gato.png') }}" alt="11 Gato">
          </td>
          <td class="bg-danger" data-value="14" data-name="Paloma" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=14 Paloma&bg=DC3545" src="{{ asset('img/animalitos/14-Paloma.png') }}" alt="14 Paloma">
          </td>
          <td class="bg-dark" data-value="17" data-name="Pavo" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=17 Pavo&bg=343A40" src="{{ asset('img/animalitos/17-Pavo.png') }}" alt="17 Pavo">
          </td>
          <td class="bg-dark" data-value="20" data-name="Cochino" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=20 Cochino&bg=343A40" src="{{ asset('img/animalitos/20-Cochino.png') }}" alt="20 Cochino">
          </td>
          <td class="bg-danger" data-value="23" data-name="Cebra" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=23 Cebra&bg=DC3545" src="{{ asset('img/animalitos/23-Cebra.png') }}" alt="23 Cebra">
          </td>
          <td class="bg-dark" data-value="26" data-name="Vaca" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=26 Vaca&bg=343A40" src="{{ asset('img/animalitos/26-Vaca.png') }}" alt="26 Vaca">
          </td>
          <td class="bg-dark" data-value="29" data-name="Elefante" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=29 Elefante&bg=343A40" src="{{ asset('img/animalitos/29-Elefante.png') }}" alt="29 Elefante">
          </td>
          <td class="bg-danger" data-value="32" data-name="Ardilla" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=32 Ardilla&bg=DC3545" src="{{ asset('img/animalitos/32-Ardilla.png') }}" alt="32 Ardilla">
          </td>
          <td class="bg-dark" data-value="35" data-name="Jirafa" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=35 Jirafa&bg=343A40" src="{{ asset('img/animalitos/35-Jirafa.png') }}" alt="35 Jirafa">
          </td>
        </tr>
        <tr class="text-center text-white">
          <td class="bg-danger" data-value="01" data-name="Carnero" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=01 Carnero&bg=DC3545" src="{{ asset('img/animalitos/01-Carnero.png') }}" alt="01 Carnero">
          </td>
          <td class="bg-dark"  data-value="04" data-name="Alacran" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=04 Alacran&bg=343A40" src="{{ asset('img/animalitos/04-Alacran.png') }}" alt="04 Alacran">
          </td>
          <td class="bg-danger" data-value="07" data-name="Perico" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=07 Perico&bg=DC3545" src="{{ asset('img/animalitos/07-Perico.png') }}" alt="07 Perico">
          </td>
          <td class="bg-dark" data-value="10" data-name="Tigre" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=10 Tigre&bg=343A40" src="{{ asset('img/animalitos/08-Raton.png') }}" alt="10 Tigre">
          </td>
          <td class="bg-dark" data-value="13" data-name="Mono" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=13 Mono&bg=343A40" src="{{ asset('img/animalitos/13-Mono.png') }}" alt="13 Mono">
          </td>
          <td class="bg-danger" data-value="16" data-name="Oso" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=16 Oso&bg=DC3545" src="{{ asset('img/animalitos/16-Oso.png') }}" alt="16 Oso">
          </td>
          <td class="bg-danger" data-value="19" data-name="Chivo" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=19 Chivo&bg=DC3545" src="{{ asset('img/animalitos/19-Chivo.png') }}" alt="19 Chivo">
          </td>
          <td class="bg-dark" data-value="22" data-name="Camello" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=22 Camello&bg=343A40" src="{{ asset('img/animalitos/22-Camello.png') }}" alt="22 Camello">
          </td>
          <td class="bg-danger" data-value="25" data-name="Gallina" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=25 Gallina&bg=DC3545" src="{{ asset('img/animalitos/25-Gallina.png') }}" alt="25 Gallina">
          </td>
          <td class="bg-dark" data-value="28" data-name="Zamuro" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=28 Zamuro&bg=343A40" src="{{ asset('img/animalitos/28-Zamuro.png') }}" alt="28 Zamuro">
          </td>
          <td class="bg-dark" data-value="31" data-name="Lapa" data-class="bg-dark">
            <img class="img-fluid" data-src="holder.js/100x50?text=31 Lapa&bg=343A40" src="{{ asset('img/animalitos/31-Lapa.png') }}" alt="31 Lapa">
          </td>
          <td class="bg-danger" data-value="34" data-name="Venado" data-class="bg-danger">
            <img class="img-fluid" data-src="holder.js/100x50?text=34 Venado&bg=DC3545" src="{{ asset('img/animalitos/34-Venado.png') }}" alt="34 Venado">
          </td>
        </tr>
        <tr class="text-center text-white">
          <td colspan="6" class="bg-dark" data-value="0" data-name="Delfin" data-class="bg-dark">
            <img class="img-fluid" width="120px;" src="{{ asset('img/animalitos/0-Delfin.png') }}" alt="0 Delfin">
          </td>
          <td colspan="6" class="bg-danger" data-value="-1" data-name="Ballena" data-class="bg-danger">
            <img class="img-fluid" width="120px;" src="{{ asset('img/animalitos/00-Ballena.png') }}" alt="00 Ballena">
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row">

    <div class="col-lg-8">
      <h3>Apuesta</h3>

      <input type="hidden" v-model="user_id" name="user_id" value="{{ Auth::id() }}"> {{-- Id de Usuario --}}

      <div class="form-group">
        {!! Form::label('date', 'Fecha', ['class' => 'control-label']) !!}
        {!! Form::hidden('available', $balance[0]->amount) !!}
        <div class="col-lg-6">
          @if ( \Carbon\Carbon::now()->format('H') > '19') {{-- Si son mas de las 7pm no se puede jugar hoy  --}}
          <p class="lead">Jugando para el sorteo del {{ \Carbon\Carbon::now(1)->format('Y-m-d') }}</p>
          {!! Form::hidden('date', \Carbon\Carbon::now(1)->format('Y-m-d')) !!}
          @else
          <p class="lead">Jugando para el sorteo del {{ \Carbon\Carbon::now() }}</p>
          {!! Form::hidden('date', \Carbon\Carbon::now()) !!}
          @endif
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('lottery_id', 'Loteria', ['class' => 'control-label']) !!}
        <div class="col-lg-6">
          {!! Form::select('lottery_id', $lottery, 1, ['class' => 'form-control']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('raffle_id', 'Sorteo', ['class' => 'control-label']) !!}
        <div class="col-lg-6">
          {!! Form::select('raffle_id', $raffles, 1, ['class' => 'form-control']) !!}
        </div>
        {{-- number --}}
        {!! Form::hidden('number', null) !!}
      </div>

      <div class="form-group">
        {!! Form::label('play', 'Jugada', ['class' => 'control-label']) !!}
        <div class="col-lg-6">
          {!! Form::text('play', null, ['class' => 'form-control','placeholder' => 'Jugada']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('amount', 'monto', ['class'=>'control-label']) !!}
        <div class="col-lg-6 form-inline">
          {!! Form::number('amount', null, ['class' => 'form-control text-right', 'placeholder' => 'Monto de la Jugada', 'step' => '100']) !!}
          &nbsp;&nbsp;&nbsp;&nbsp;
          <button id="addMove" name="addMove" type="button" title="Add Play" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
          &nbsp;&nbsp;&nbsp;&nbsp;
        </div>
      </div>

      <hr>
    </div>

    <div class="col-lg-4">
      {{-- error --}}
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      {{-- error --}}
      {{-- Example component VueJS --}}
      <div id="ticketplay">
        <my-ticket></my-ticket>
      </div>
      {{-- Example component VueJS --}}
      {!! Form::open(['method' => 'POST', 'route'=> 'toplay.store', 'class' => 'form-horizontal','id' => 'playing']) !!}
      <h3>Total Apuesta</h3>
      <p class="lead text-right">{{ \Carbon\Carbon::now() }}</p>
      <table class="table table-bordered table-condensed">
        <caption>Tickets</caption>
        <thead>
          <tr>
            <th>Sorteo</th>
            <th>Jugada</th>
            <th>Apuesta</th>
          </tr>
        </thead>
        <tbody id="move">
          {{-- Jugada --}}
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="text-right">Bs. <span id="total"></span></td>
          </tr>
          <tr>
            <td colspan="2" class="text-right">Saldo Disponible</td>
            <td class="text-right text-success"><span id="available"></span></td>
          </tr>
          <tr>
            <td colspan="2" class="text-right">Saldo Restante</td>
            <td class="text-right text-success"><span id="rest"></span></td>
          </tr>
        </tfoot>
      </table>
      {!! Form::hidden('ticket', null) !!}
      {!! Form::submit('Apostar', ['class' => 'btn btn-success']) !!}
      <button id="cancel" class="btn btn-warning" type="button">Cancel</button>
      {!! Form::close() !!}

    </div>

  </div>
</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/holder.min.js') }}"></script>

<script type="text/javascript">
  $(function(){

    $(function(){
      $('td').click(function(){

      if ( $(this).hasClass('bg-dark') ){ //Si es negro cambia a verde
        $(this).attr('class','bg-success');
        $('input:text[name=play]').val( $(this).data('name'));
        $('input:hidden[name=number]').val( $(this).data('value') );
        $('#amount').focus();
      }else if ( $(this).hasClass('bg-danger') ){ //Si es rojo cambia a verde
        $(this).attr('class','bg-success');
        $('input:text[name=play]').val( $(this).data('name'));
        $('input:hidden[name=number]').val( $(this).data('value') );
        $('#amount').focus();
      }else if ( $(this).hasClass('bg-success') ){
        var Class = $(this).attr('data-class');
        $('#play').val('');
        $('#number').val('');
        $(this).attr('class', Class);
      }

    });
    });

    $(function(){
      var bet = new Array();
      var row = 0;
      var total = 0;
      var saldo = $('input:hidden[name=available]').val();

      $('#available').text( $('input:hidden[name=available]').val() );

      $('#addMove').click(function(){
        if ( $('#amount').val() > 0 ){
          var user_id = $('input:hidden[name=user_id]').val();
          var date = $('#date').val();
          var lottery_id = $('#lottery_id').val();
          var raffle_id = $('#raffle_id').val();
          var number = $('input:hidden[name=number]').val();
          var play = $('input:text[name=play]').val();
          var amount = $('#amount').val();
          total = parseInt(total) + parseInt(amount);

          bet.push( {user: user_id, date: date, lottery: lottery_id, raffle: raffle_id, number: number, play: play, amount: amount} );

          $('#move').append('<tr><td>' + $('#raffle_id option:selected').text() + '</td><td>' + number + ' - ' + play + '</td><td class="text-right">Bs. ' + amount + '</td></tr>');
          console.log(total);
          $('#total').text(total);
          // Saldo restante
          $('#rest').text( saldo - total);

          $('input:hidden[name=ticket]').val(JSON.stringify(bet));
          console.log( JSON.stringify(bet) );

        }else {
          swal(
               'Oops...',
               'Debe indicar el monto a apostar!',
               'error'
               )
        }
      });

      $('#cancel').click(function() {
        console.log('click');
        location.reload();
      });

    });

  });
</script>
@endsection