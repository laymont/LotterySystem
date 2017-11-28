@extends('layouts.app')

@section('content')

<div id="wrapper" class="container-fluid">
  <div class="row">
    <div class="col-lg-4">
      <h3>Play with VueJS</h3>
      <form id="maketicket">
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
          <input type="number" name="number" v-model="number" value="" max="38" placeholder="Numero a Jugar" class="form-control" number>
        </div>

        <div class="form-group">
          <label for="amount">Monto</label>
          <input type="number" name="amount" v-model="amount" step="100" value="" placeholder="Monto a Jugar" class="form-control" number>
        </div>

        <div class="form-group">
          <button type="button" v-on:click="addPlay" class="btn btn-primary">Apostar</button>
        </div>
      </form>
    </div>

    <div class="col-lg-4">
      <h3>&nbsp;</h3>
      <div id="ticket" class="card">
        <div class="card-header"><h4>Ticket # {!! $numberTicket = time() . '-' . mt_rand(0,38); !!}</h4></div>
        <div class="card-body">
          <h5 class="card-title">Fecha: {{ \Carbon\Carbon::now()->format('Y-m-d') }}</h5>
          <div class="row">
            <div class="col-lg-4">
              <p :prop="plays.number">Numero: @{{ plays.number }}</p>
            </div>
            <div class="col-lg-4">

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/vue-resource.js') }}"></script>

<script type="text/javascript">
  $(function(){

    var app = new Vue({
      el: '#wrapper',
      mounted: function() {
        this.options = {!! json_encode($raffles) !!}
      },
      data: {
        lottery_id: '1',
        raffle_id: '',
        options: [],
        number: '',
        amount: '',
        plays: [],
      },
      methods: {
        addPlay: function() {
          this.plays.push({
            number: this.number,
            amount: this.amount,
          });
        }
      }
    })

  })
</script>
@endsection