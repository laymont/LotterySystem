@extends('layouts.app')

@section('content')

<div id="wrapper" class="container-fluid">
  <div class="row">
    <div class="col-lg-7">
      {{-- Tablero --}}
      <h3>Tablero de Juego <span class="float-right" v-text="currentTime"></span></h3>
      <table class="table table-condensed table-bordered" id="board">
        <caption>Tablero de Juego</caption>
        <tbody>
          <tr>
            <td data-value="6" data-name="Rana" v-on:click="number = 6">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/06-Rana.png') }}" title="Rana" alt="">
            </td>
            <td data-value="12" data-name="Caballo" v-on:click="number = 12">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/12-Caballo.png') }}" title="Caballo" alt="">
            </td>
            <td data-value="18" data-name="Burro" v-on:click="number = 18">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/18-Burro.png') }}" title="Burro" alt="">
            </td>
            <td data-value="24" data-name="Iguana" v-on:click="number = 24">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/24-Iguana.png') }}" title="Iguana" alt="">
            </td>
            <td data-value="30" data-name="Caiman" v-on:click="number = 30">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/30-Caiman.png') }}" title="Caiman" alt="">
            </td>
            <td data-value="36" data-name="Culebra" v-on:click="number = 36">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/36-Culebra.png') }}" title="Culebra" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="5" data-name="Leon" v-on:click="number = 5">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/05-Leon.png') }}" title="Leon" alt="">
            </td>
            <td data-value="11" data-name="Gato" v-on:click="number = 11">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/11-Gato.png') }}" title="Gato" alt="">
            </td>
            <td data-value="17" data-name="Pavo" v-on:click="number = 17">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/17-Pavo.png') }}" title="Pavo" alt="">
            </td>
            <td data-value="23" data-name="Cebra" v-on:click="number = 23">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/23-Cebra.png') }}" title="Cebra" alt="">
            </td>
            <td data-value="29" data-name="Elefante" v-on:click="number = 29">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/29-Elefante.png') }}" title="Elefante" alt="">
            </td>
            <td data-value="35" data-name="Jirafa" v-on:click="number = 35">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/35-Jirafa.png') }}" title="Jirafa" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="4" data-name="Alacran" v-on:click="number = 4">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/04-Alacran.png') }}" title="Alacran" alt="">
            </td>
            <td data-value="10" data-name="Tigre" v-on:click="number = 10">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/10-Tigre.png') }}" title="Tigre" alt="">
            </td>
            <td data-value="16" data-name="Oso" v-on:click="number = 16">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/16-Oso.png') }}" title="Oso" alt="">
            </td>
            <td data-value="22" data-name="Camello" v-on:click="number = 22">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/22-Camello.png') }}" title="Camello" alt="">
            </td>
            <td data-value="28" data-name="Zamuro" v-on:click="number = 28">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/28-Zamuro.png') }}" title="Zamuro" alt="">
            </td>
            <td data-value="34" data-name="Venado" v-on:click="number = 34">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/34-Venado.png') }}" title="Venado" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="3" data-name="Ciempies" v-on:click="number = 3">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/03-Ciempies.png') }}" alt="">
            </td>
            <td data-value="9" data-name="Aguila" v-on:click="number = 9">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/09-Aguila.png') }}" alt="">
            </td>
            <td data-value="15" data-name="Zorro" v-on:click="number = 15">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/15-Zorro.png') }}" alt="">
            </td>
            <td data-value="21" data-name="Gallo" v-on:click="number = 21">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/21-Gallo.png') }}" alt="">
            </td>
            <td data-value="27" data-name="Perro" v-on:click="number = 27">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/27-Perro.png') }}" alt="">
            </td>
            <td data-value="33" data-name="Pescado" v-on:click="number = 33">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/33-Pescado.png') }}" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="2" data-name="Toro" v-on:click="number = 2">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/02-Toro.png') }}" alt="">
            </td>
            <td data-value="8" data-name="Raton" v-on:click="number = 8">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/08-Raton.png') }}" alt="">
            </td>
            <td data-value="14" data-name="Paloma" v-on:click="number = 14">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/14-Paloma.png') }}" alt="">
            </td>
            <td data-value="20" data-name="Cochino" v-on:click="number = 20">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/20-Cochino.png') }}" alt="">
            </td>
            <td data-value="26" data-name="Vaca" v-on:click="number = 26">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/26-Vaca.png') }}" alt="">
            </td>
            <td data-value="32" data-name="Ardilla" v-on:click="number = 32">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/32-Ardilla.png') }}" alt="">
            </td>
          </tr>
          <tr>
            <td data-value="1" data-name="Carnero" v-on:click="number = 1">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/01-Carnero.png') }}" alt="">
            </td>
            <td data-value="7" data-name="Perico" v-on:click="number = 7">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/07-Perico.png') }}" alt="">
            </td>
            <td data-value="13" data-name="Mono" v-on:click="number = 13">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/13-Mono.png') }}" alt="">
            </td>
            <td data-value="19" data-name="Chivo" v-on:click="number = 19">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/19-Chivo.png') }}" alt="">
            </td>
            <td data-value="25" data-name="Gallina" v-on:click="number = 25">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/25-Gallina.png') }}" alt="">
            </td>
            <td data-value="25" data-name="Lapa" v-on:click="number = 31">
              <img class="img-fluid" data-src="holder.js/100x50?ImgAnimal" src="{{ asset('img/animalitos/31-Lapa.png') }}" alt="">
            </td>
          </tr>
          <tr>
            <td colspan="3" data-value="0" data-name="Delfin" v-on:click="number = 0">
              <img class="img-fluid text-center align-middle mx-auto d-block" width="120px" src="{{ asset('img/animalitos/0-Delfin.png') }}" alt="">
            </td>
            <td colspan="3" data-value="-1" data-name="Ballena" v-on:click="number = -1">
              <img class="img-fluid text-center align-middle mx-auto d-block" width="120px" src="{{ asset('img/animalitos/00-Ballena.png') }}" alt="">
            </td>
          </tr>
        </tbody>
      </table>
      {{-- Tablero --}}
    </div>
    {{-- instancia 2 Vue --}}

    <div class="col-lg-2">
      <h3>Play with VueJS</h3>
      <form id="maketicket">

        <div class="form-group">
          <label for="date">Fecha</label>
          <span>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span>
          <input type="hidden" name="date" v-model="date" value="">
        </div>

        <div class="form-group">
          <label for="lottery_id" class="control-label">Loteria</label>
          <select name="lottery_id" v-model="lottery_id"  class="form-control">
            <option value="">Selección/Loteria</option>
            @foreach ($lottery_list as $element)
            <option value="{{ $element->id }}" selected>{{ $element->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="raffle_id" class="control-label">Sorteo</label>
          <select v-model="raffle_id" name="raffle_id" class="form-control">
            <option v-for="option in options" v-bind:value="option.id">
              @{{ option.hour }}
            </option>
          </select>
        </div>

        <div class="form-group">
          <label for="number" class="control-label">Numero</label>
          <input type="number" name="number" v-model="number" value="" min="-1" max="38" placeholder="Numero a Jugar" class="form-control" number>
        </div>

        <div class="form-group">
          <label for="amount">Monto</label>
          <input type="number" name="amount" v-model="amount" min="100" max="20000" step="100" value="" placeholder="Monto a Jugar" class="form-control" number>
        </div>

        <div class="form-group">
          <button type="button" v-on:click="addPlay" class="btn btn-primary">Jugar</button>
        </div>
      </form>
    </div>

    <div class="col-lg-3">
      <h3>&nbsp;</h3>
      <div id="ticket" class="card">
        <div class="card-header"><h4>Ticket # {!! $numberTicket = time() . '-' . mt_rand(0,38); !!}</h4></div>
        <div class="card-body">
          <h5 class="card-title">Fecha: {{ \Carbon\Carbon::now()->format('Y-m-d') }}</h5>


          <h5>Loteria: @{{ lottery_id }} <span v-if="raffle_id"> Sorteo: @{{ raffle_id }}</span> </h5>
          <div v-if="plays">
            <!-- Form to register your bet -->
            <table class="table table-bordered table-hover">
              <caption>Ticket</caption>
              <thead>
                <tr>
                  <th>Sorteo/Hr/Numero</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="play in plays">
                  <td class="text-center align middle">
                    <span v-for="item in play.hour">@{{ item.hour }}</span>
                    <span class="float-left">
                      <button v-on:click="deletePlays" type="button" class="btn btn-sm btn-warning"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                    </span>
                    <span class="float-right" v-for="item in play.animal">
                      @{{ item.animal }}
                    </span>
                  </td>
                  <td class="text-right  align middle">@{{ play.amount }}</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td class="text-right">Total</td>
                  <td class="text-right"> @{{ total }} </td>
                </tr>
              </tfoot>
            </table>
            {!! Form::open(['method' => 'POST', 'route'=> 'toplay.store', 'class' => 'form-horizontal','id' => 'playing']) !!}
            <input type="hidden" name="ticket" value="" v-model="ticket" ref="ticketData">
            <button type="submit" class="btn btn-success" @keyup.enter.prevent="submitform">Apostar</button>
            <button @click.prevent="getFormValues()">Get values</button>
            {!! Form::close() !!}
            <p>Output: @{{ output }}</p>
            <!-- Form end -->
          </div>
        </div>
      </div>
    </div>
    {{-- instancia 2 Vue --}}

  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/holder.min.js') }}"></script>

<script type="text/javascript">

$(function(){

  var app = new Vue({

    el: '#wrapper',
    mounted: function() {
      this.options = {!! json_encode($raffles) !!}
    },
    data: {
      currentTime: null,
      date: '',
      lottery_id: '1',
      raffle_id: '',
      options: [],
      number: '',
      animals: '',
      amount: '',
      plays: [],
      animals: [
      { number: '-1', animal: '00-Ballena' },
      { number:'0', animal:'0-Delfin' },
      { number:'1', animal:'01-Carnero' },
      { number:'2', animal:'02-Toro' },
      { number:'3', animal:'03-Cienpies' },
      { number:'4', animal:'04-Alacran' },
      { number:'5', animal:'05-Leon' },
      { number:'6', animal:'06-Rana' },
      { number:'7', animal:'07-Perico' },
      { number:'8', animal:'08-Raton' },
      { number:'9', animal:'09-Aguila' },
      { number:'10', animal:'10-Tigre' },
      { number:'11', animal:'11-Gato' },
      { number:'12', animal:'12-Caballo' },
      { number:'13', animal:'13-Mono' },
      { number:'14', animal:'14-Paloma' },
      { number:'15', animal:'15-Zorro' },
      { number:'16', animal:'16-Oso' },
      { number:'17', animal:'17-Pavo' },
      { number:'18', animal:'18-Burro' },
      { number:'19', animal:'19-Chivo' },
      { number:'20', animal:'20-Cochino' },
      { number:'21', animal:'21-Gallo' },
      { number:'22', animal:'22-Camello' },
      { number:'23', animal:'23-Cebra' },
      { number:'24', animal:'24-Iguana' },
      { number:'25', animal:'25-Gallina' },
      { number:'26', animal:'26-Vaca' },
      { number:'27', animal:'27-Perro' },
      { number:'28', animal:'28-Zamuro' },
      { number:'29', animal:'29-Elefante' },
      { number:'30', animal:'30-Caiman' },
      { number:'31', animal:'31-Lapa' },
      { number:'32', animal:'32-Ardilla' },
      { number:'33', animal:'33-Pescado' },
      { number:'35', animal:'35-Jirafa' },
      { number:'36', animal: '36-Culebra'}
      ],
      ticket: null,
      output: '',
    },
    computed: {

      setDate(){
        this.date = moment().format('YYYY-M-D');
      },

      showHour: function(){
        var hours = {!! json_encode($raffles); !!}
        var raffle = this.raffle_id;
        return hours.filter(function(item){
          return item.id == raffle;
        });
      },

      showAnimal: function(){
        var numberShow = this.number;
        return this.$data.animals.filter(function(item){
          return item.number == numberShow;
        })
      },

      total(){
        return sum = this.plays.reduce((total, item) => total + parseFloat(item.amount), 0);
      }

    },
    methods: {
      updateCurrenTime(){
        this.currentTime = moment().format('LTS');
      },
      addPlay: function() {
        this.plays.push({
          hour: this.showHour,
          number: this.number,
          animal: this.showAnimal,
          amount: this.amount,
        });
        this.ticket = this.plays;
      },
      deletePlays: function(index){
        this.plays.splice(index,1);
      },
      getFormValues () {
        this.output = JSON_stringify(this.$refs.ticketData.value)
      },
      submitform() {

      }
    },
    created(){
      this.currenTime= moment().format('LTS');
      setInterval( () => this.updateCurrenTime(),1 * 1000 );
    }
  })

})
</script>
@endsection