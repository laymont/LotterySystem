@extends('layouts.app')

@section('csss')
<style type="text/css" media="screen">
.amount-peding { font-size: 0.7em; }
</style>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row margin-nav">
    <div class="col-lg-6">
      {{-- B4 --}}
      <div class="card">
        <h3 class="card-header bg-info text-white"> Mi Cuenta | <small id="time"></small></h3>
        <div class="card-body">
          <h4 class="card-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Información General de mi Cuenta  </h4>
          <div class="row card-body">
            <div class="col-lg-6">
              <h6 class="card-subtitle mb-2"><span class="text-muted">Nombre: </span>{{ Auth::user()->name }}</h6>
              <h6 class="card-subtitle"><span class="text-muted">Usuario desde: </span> {{ Auth::user()->created_at->format('Y-m-d') }}</h6>
              <div class="card-block">
                <ul class="list-group">
                  <a href="{{ route('users.show', ['id' => Auth::user()->id]) }}" class="list-group-item list-group-item-action"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Mis Datos</a>
                  <a href="{{ route('ctausers.show', ['id' => Auth::id()]) }}" class="list-group-item list-group-item-action"><i class="fa fa-money" aria-hidden="true"></i> Mi Saldo</a>
                  <a href="{{ route('toplay.create') }}" class="list-group-item list-group-item-action list-group-item-success"><i class="fa fa-play" aria-hidden="true"></i> Jugar</a>
                  <a href="{{ url('results') }}" class="list-group-item list-group-item-action"><i class="fa fa-search" aria-hidden="true"></i> Resultados</a>
                  <a href="{{ route('results.statistics') }}" class="list-group-item list-group-item-action"><i class="fa fa-bar-chart" aria-hidden="true"></i> Estadisticas</a>
                </ul>
              </div>
            </div>
            @if(Auth::user()->hasRole('admin'))
            <div class="col-lg-6">
              {{-- Acciones Administrador --}}
              <h6>Acciones Administración</h6>
              <div class="card-block">
                <ul class="list-group">
                  <a href="{{ route('toplay.showtickets') }}" class="list-group-item list-group-item-action"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Tickets <small>del Día</small></a>
                  <a id="amountplay" href="#" data-toggle="modal" data-target="#raffleplayamount" class="list-group-item list-group-item-action"><i class="fa fa-money" aria-hidden="true"></i> Monto Jugado <small>Sorteo Actual</small></a>
                  <a href="{{ route('results.winners') }}" class="list-group-item list-group-item-action list-group-item-success"><i class="fa fa-play" aria-hidden="true"></i> Ganadores <small>Tickets</small></a>
                  <a href="{{ route('results.create') }}" class="list-group-item list-group-item-action"><i class="fa fa-search" aria-hidden="true"></i> Resultado <small>Registrar</small></a>
                  <a href="#" class="list-group-item list-group-item-action disabled"><i class="fa fa-search-plus" aria-hidden="true"></i> Historial</a>
                </ul>
              </div>
              {{-- Acciones Administrador --}}
            </div>
            @endif
          </div>
        </div>
      </div>
      {{-- B4 --}}
    </div>
    {{-- Informacion de Administracion --}}
    <div class="col-lg-6">
      <div class="card">
        <h3 class="card-header bg-primary text-white">Informacion General</h3>
        <div class="card-body">
          {{-- Retiros pendientes --}}
          @if ($retreats->isNotEmpty())
          <h4 class="card-title text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Retiros pendientes por <a href="{{ route('regains.index') }}" title="Retiro" class="btn btn-danger btn-sm"> Aprobar</a></h4>
          @endif
          {{-- Retiros pendientes --}}
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
                <td>
                  @if(Auth::user()->hasRole('admin'))
                  <a class="btn btn-sm btn-info" href="{{ route('results.notifyposttime', ['raffle_id' => $item->id]) }}" title="Notificar"> {{ $item->hour }}</a>
                  @else
                  {{ $item->hour }}
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
          @if($amountpending->count() > 0)
          <h4 class="card-title text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> Abonos pendientes por Aprobar </h4>
          <div class="card-block">
            <table class="table table-condensed table-bordered table-striped amount-peding">
              <caption>Abonos Pendientes</caption>
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>F/Registro</th>
                  <th>Monto/Abono</th>
                  <th>Banco</th>
                  <th>Tipo</th>
                  <th>Referencia</th>
                  <th>Aprobar</th>
                </tr>
              </thead>
              <tbody>
                @foreach($amountpending as $item)
                <tr>
                  <td>{{ $item->user }}</td>
                  <td>{{ $item->payment_day }}</td>
                  <td>{{ number_format($item->payment,2,",",".") }}</td>
                  <td>{{ $item->bank }}</td>
                  <td>{{ $item->type }}</td>
                  <td>{{ $item->reference }}</td>
                  <td>
                   @if(Auth::user()->hasRole('admin'))
                   <a id="btn-accept" class="btn btn-sm btn-success" href="{{ route('confirmedpay',['id'=>$item->id]) }}" title="Aprobar"> Aprobar</a>
                   @else
                   <span class="text-warning"> <strong>Pendiente</strong></span>
                   @endif
                 </td>
               </tr>
               @endforeach
             </tbody>
           </table>
           @else
           <h4 class="card-title text-success"><i class="fa fa-info-circle" aria-hidden="true"></i> No hay Abonos pendientes por Aprobar </h4>
           @endif
           {{-- Informacion de Jugadas --}}
           <div id="test">
            @if(Session::has('new'))
            {{ Session::get() }}
            @endif
          </div>
          {{-- Modal Ticket --}}
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ticket</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <table id="viewticket" class="table table-bordered">
                    <caption>Ticket <span id="numberticket"></span></caption>
                    <thead>
                      <tr>
                        <th>Jugada</th>
                        <th>Monto</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in elTicket">
                        <td class="text-center" v-text="item.number"></td>
                        <td class="text-right" v-text="item.amount"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button id="closeticket" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
              </div>
            </div>
          </div>
          {{-- Modal Ticket --}}
          {{-- Modal monto total jugado sorteo --}}
          <div class="modal fade" id="raffleplayamount" tabindex="-1" role="dialog" aria-labelledby="raffleplayamount" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="raffleplayamount">Monto Jugado</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h2>Sorteo Actual</h2>
                  <h2 id="elamountactual" class="text-right">Bs. @{{ totalamount }}</h2>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
              </div>
            </div>
          </div>
          {{-- Modal monto total jugado sorteo --}}
          {{-- tickets actuales --}}
          @if ($tickets->count() > 0)
          <div class="card">
            <h4 class="card-header bg-info text-white"> Tickets <small>Actuales</small></h4>
            <table class="table table-condensed table-bordered">
              <caption>Tickets</caption>
              <thead>
                <tr>
                  <th>Tickets</th>
                  <th>Fecha</th>
                  <th>Loteria</th>
                  <th>Hora</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
                @foreach($tickets as $item)
                <tr>
                  <td class="text-center">
                    <a id="showticket" class="btn btn-sm btn-info sticket" href="{{ route('toplay.show', ['toplay' => $item->ticket]) }}" title="Ticket"> {{ $item->ticket }}</a>
                  </td>
                  <td class="text-center">{{ $item->date }}</td>
                  <td>{{ $item->lottery }}</td>
                  <td class="text-center">{{ $item->hour }}</td>
                  <td class="text-right">Bs. {{ number_format($item->amount,2,",",".") }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
          <h4 class="card-title text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> No hay Tickets jugando </h4>
          @endif
          {{-- tickets actuales --}}
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  moment.locale('es-ve');
  function showTheTime() {
    var s = moment().format('MMMM DD YYYY, h:mm:ss a');
    document.getElementById("time").innerHTML = s;
  }
  showTheTime(); // for the first load
  setInterval(showTheTime, 1 * 1000); // update it periodically
</script>
</script>
<script type="text/javascript">

  $(document).ready(function(){

    // swal("Good job!", "You clicked the button!", "success");

    $('#btn-accept').click(function(){
      console.log('click');
    });

    /* Vaciar resultado ticket */
    /*$('#closeticket').click(function(){
      $('#viewticket').empty();
    })*/

    /* Ver monto jugado del dia */
    $('#amountplay').click(function(){
      new Vue({
        el: '#elamountactual',
        created: function() {
          this.getAmount();
        },
        data: {
          totalamount: []
        },
        methods: {
          getAmount: function() {
            axios.get('_raffleamount').then(response => {
              this.totalamount = response.data
            });
          }
        }
      });
    });

  });


</script>
@endsection

