@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    {{-- Form --}}
    <div class="col-lg-3">
      <h3>Jugada</h3>
      {{-- Reloj LIVE --}}
      <div id="time"></div>
      {{-- Form --}}
      <div>
        {!! Form::open(['method' => 'POST', 'route'=> 'toplay.store', 'class' => 'form-horizontal','id' => 'ticketShow']) !!}

        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="ticket" value="{{ $numberTicket }}">

        <div class="form-group">
          {!! Form::label('date', 'Fecha', ['class'=>'control-label']) !!}
          {!! Form::date('date', \Carbon\Carbon::now(), ['class'=>'form-control','readonly']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('lottery_id', 'Loteria', ['class'=>'control-label']) !!}
          {!! Form::select('lottery_id', $lottery_list, 0, ['class'=>'form-control','readonly']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('raffle_id', 'Sorteo', ['class'=>'control-label']) !!}
          {!! Form::select('raffle_id', $raffles, 0, ['class'=>'form-control','placeholder'=>'Seleccion/Sorteo']) !!}
          <span id="alertRaffle" class="help-block text-danger"><small>Antes de comenzar su Apuesta debe seleccionar el Sorteo</small></span>
        </div>
        <input type="hidden" name="raffleid" id="raffleid">
        <div class="form-group">
          {!! Form::label('number', 'Numero', ['class'=>'control-label']) !!}
          {!! Form::number('number', null, ['class'=>'form-control','placeholder'=>'Numero a Jugar','readonly']) !!}
        </div>

        <input type="hidden" name="numbers" id="numbers">

        <div class="form-group">
          {!! Form::label('amount', 'Monto', ['class'=>'control-label']) !!}
          {!! Form::number('amount', null, ['class'=>'form-control','placeholder'=>'Monto a Apostar','min'=>100,'step'=>100]) !!}
        </div>

        <input type="hidden" name="amounts" id="amounts">

        <div class="form-group">
          <button id="addNumber" type="button" class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"></i> ADD</button>
          &nbsp;&nbsp;
          <button id="play" class="btn btn-lg btn-success">Jugar</button>
        </div>

        {!! Form::close() !!}
      </div>
      {{-- Form --}}
    </div>

    <div id="dashboard" class="col-lg-6" style="display: none;">
      <h3>Jugar</h3>
      <span class="help-block"><small class="text-info">Haga click sobre la imagen de Numero (Animalito) que desea jugar</small></span>
      {{-- Tablero --}}
      <table class="table table-condensed table-bordered" id="board">
        <caption>Tablero de Juego </caption>
        <tbody>
          <tr>
            <td data-value="6" data-name="Rana">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/06-Rana.png') }}" title="Rana" alt="">
            </td>
            <td data-value="12" data-name="Caballo">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/12-Caballo.png') }}" title="Caballo" alt="">
            </td>
            <td data-value="18" data-name="Burro">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/18-Burro.png') }}" title="Burro" alt="">
            </td>
            <td data-value="24" data-name="Iguana">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/24-Iguana.png') }}" title="Iguana" alt="">
            </td>
            <td data-value="30" data-name="Caiman">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/30-Caiman.png') }}" title="Caiman" alt="">
            </td>
            <td data-value="36" data-name="Culebra">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/36-Culebra.png') }}" title="Culebra" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="5" data-name="Leon">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/05-Leon.png') }}" title="Leon" alt="">
            </td>
            <td data-value="11" data-name="Gato">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/11-Gato.png') }}" title="Gato" alt="">
            </td>
            <td data-value="17" data-name="Pavo">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/17-Pavo.png') }}" title="Pavo" alt="">
            </td>
            <td data-value="23" data-name="Cebra">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/23-Cebra.png') }}" title="Cebra" alt="">
            </td>
            <td data-value="29" data-name="Elefante">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/29-Elefante.png') }}" title="Elefante" alt="">
            </td>
            <td data-value="35" data-name="Jirafa">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/35-Jirafa.png') }}" title="Jirafa" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="4" data-name="Alacran">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/04-Alacran.png') }}" title="Alacran" alt="">
            </td>
            <td data-value="10" data-name="Tigre">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/10-Tigre.png') }}" title="Tigre" alt="">
            </td>
            <td data-value="16" data-name="Oso">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/16-Oso.png') }}" title="Oso" alt="">
            </td>
            <td data-value="22" data-name="Camello">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/22-Camello.png') }}" title="Camello" alt="">
            </td>
            <td data-value="28" data-name="Zamuro">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/28-Zamuro.png') }}" title="Zamuro" alt="">
            </td>
            <td data-value="34" data-name="Venado">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/34-Venado.png') }}" title="Venado" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="3" data-name="Ciempies">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/03-Ciempies.png') }}" alt="">
            </td>
            <td data-value="9" data-name="Aguila">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/09-Aguila.png') }}" alt="">
            </td>
            <td data-value="15" data-name="Zorro">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/15-Zorro.png') }}" alt="">
            </td>
            <td data-value="21" data-name="Gallo">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/21-Gallo.png') }}" alt="">
            </td>
            <td data-value="27" data-name="Perro">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/27-Perro.png') }}" alt="">
            </td>
            <td data-value="33" data-name="Pescado">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/33-Pescado.png') }}" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="2" data-name="Toro">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/02-Toro.png') }}" alt="">
            </td>
            <td data-value="8" data-name="Raton">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/08-Raton.png') }}" alt="">
            </td>
            <td data-value="14" data-name="Paloma">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/14-Paloma.png') }}" alt="">
            </td>
            <td data-value="20" data-name="Cochino">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/20-Cochino.png') }}" alt="">
            </td>
            <td data-value="26" data-name="Vaca">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/26-Vaca.png') }}" alt="">
            </td>
            <td data-value="32" data-name="Ardilla">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/32-Ardilla.png') }}" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="1" data-name="Carnero">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/01-Carnero.png') }}" alt="">
            </td>
            <td data-value="7" data-name="Perico">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/07-Perico.png') }}" alt="">
            </td>
            <td data-value="13" data-name="Mono">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/13-Mono.png') }}" alt="">
            </td>
            <td data-value="19" data-name="Chivo">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/19-Chivo.png') }}" alt="">
            </td>
            <td data-value="25" data-name="Gallina">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/25-Gallina.png') }}" alt="">
            </td>
            <td data-value="25" data-name="Lapa">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/31-Lapa.png') }}" alt="">
            </td>
          </tr>
          <tr>
            <td colspan="3" data-value="0" data-name="Delfin">
              <img class="img-fluid text-center align-middle mx-auto d-block" width="120px" src="{{ asset('img/animalitos/0-Delfin.png') }}" alt="">
            </td>
            <td colspan="3" data-value="-1" data-name="Ballena">
              <img class="img-fluid text-center align-middle mx-auto d-block" width="120px" src="{{ asset('img/animalitos/00-Ballena.png') }}" alt="">
            </td>
          </tr>
        </tbody>
      </table>
      {{-- Tablero --}}
    </div>

    {{-- Ticket --}}
    <div class="col-lg-3">
      <h3>Ticket <small>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</small></h3>

      <div class="form-group">
        <p>{{ $numberTicket }}</p>
      </div>
      <table class="table table-bordered table-condensed" id="tableVue">
        <caption>Ticket</caption>
        <thead>
          <tr>
            <th>Hora</th>
            <th>Numero</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody id="plays">
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2" class="text-right">Total:</td>
            <td class="text-right"><span id="totalplay"></span></td>
          </tr>
        </tfoot>
      </table>

    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  function showTheTime() {
    var s = moment().format('MMMM DD YYYY, h:mm:ss a');
    document.getElementById("time").innerHTML = s;
  }
  showTheTime(); // for the first load
  setInterval(showTheTime, 250); // update it periodically
</script>

<script type="text/javascript">
  $(function(){
    console.log('Run jQuery');

    var numbers = new Array();
    var amounts = new Array();
    var total = parseFloat(0);
    var animals = [
    ['-1','00-Ballena'],
    ['0','0-Delfin'],
    ['1','01-Carnero'],
    ['2','02-Toro'],
    ['3','03-Cienpies'],
    ['4','04-Alacran'],
    ['5','05-Leon'],
    ['6','06-Rana'],
    ['7','07-Perico'],
    ['8','08-Raton'],
    ['9','09-Aguila'],
    ['10','10-Tigre'],
    ['11','11-Gato'],
    ['12','12-Caballo'],
    ['13','13-Mono'],
    ['14','14-Paloma'],
    ['15','15-Zorro'],
    ['16','16-Oso'],
    ['17','17-Pavo'],
    ['18','18-Burro'],
    ['19','19-Chivo'],
    ['20','20-Cochino'],
    ['21','21-Gallo'],
    ['22','22-Camello'],
    ['23','23-Cebra'],
    ['24','24-Iguana'],
    ['25','25-Gallina'],
    ['26','26-Vaca'],
    ['27','27-Perro'],
    ['28','28-Zamuro'],
    ['29','29-Elefante'],
    ['30','30-Caiman'],
    ['31','31-Lapa'],
    ['32','32-Ardilla'],
    ['33','33-Pescado'],
    ['35','35-Jirafa'],
    ['36','36-Culebra']
    ];
    // console.info(animals);

    $('#play').hide();

    $("#raffle_id option:selected").text(); //Hora seleccionada
    console.log($("#raffle_id").val());

    $('#raffle_id').change(function(){
      console.log( $('#raffle_id option:selected').val() );
      $('#dashboard').show();
      $('#alertRaffle').hide();
      $('#raffleid').val($(this).val());
      $(this).attr('disabled', 'disabled');
    })

    $('#number').click(function(){
      var advancePlay = confirm('Desea Jugar de Forma Avanzada?');
      if (advancePlay){
        $('#number').removeAttr('readonly');
      }else {
        $('#dashboard').focus();
      }
    })

    $('td').click(function(){
      $('#number').val($(this).data('value'));
      $('#amount').focus();
    })

    $('#addNumber').click(function(){
      if( $("#raffle_id").val() ==='') {
        swal({
          title: 'Que Sorteo?',
          type: 'warning',
          html: $('<div>')
          .addClass('some-class')
          .text('Seleccione el Sorteo donde realizara la apuesta.'),
          animation: false,
          customClass: 'animated tada'
        });
        return false;
      }else if ( $('#number').val() === '' ){
        swal({
          title: 'Que Animalito?',
          type: 'warning',
          html: $('<div>')
          .addClass('some-class')
          .text('Indique a que numero apuesta.'),
          animation: false,
          customClass: 'animated tada'
        });
        return false;
      }else if( $('#amount').val() ==='') {
        swal({
          title: 'Cuanto apuesta?',
          type: 'warning',
          html: $('<div>')
          .addClass('some-class')
          .text('Indique monto a jugar.'),
          animation: false,
          customClass: 'animated tada'
        });
        return false;
      }else{
        numbers.push( $('#number').val() );
        // $('#numbers').val(numbers);
        amounts.push( $('#amount').val() );
        // $('#acounts').val(amounts);

        $('#play').show();
      }

      var resultAnimal;
      for (var i = animals.length - 1; i >= 0; i--) {
        if( animals[i][0] == $('#number').val() ){
          resultAnimal = animals[i][1];
        }
      }
      console.log('ResultAnimal:' + resultAnimal);


      $('#plays').append('<tr><td id="btnrmv" class="text-center">'+ $("#raffle_id option:selected").text() +'</td><td class="text-center">'+ resultAnimal +'</td><td class="text-right">'+ parseFloat($('#amount').val()) +'</td></tr>');

      total = parseFloat($('#amount').val()) + parseFloat(total);



      console.log(total);
      console.log('Numbers: ' + $('#numbers').val(numbers) + ' Amounts: ' + $('#amounts').val(amounts));

      $('#totalplay').html(parseFloat(total));

      $('#number').val('');
      $('#amount').val('');
    })//End addNumber
  })
</script>

@endsection