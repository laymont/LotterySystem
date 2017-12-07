@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <a class="btn btn-sm btn-info float-right" href="{{ url('home') }}" title="Regresar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>&nbsp;
  <div class="row">
    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Ticket <small>
            {{-- <a class="btn btn-sm btn-info" href="{{ route('toplay.printticket', ['ticket' => $viewticket->first()->ticket]) }}" title="Imprimir">Imprimir</a> --}}
          </small></h4>
          <h6 class="card-subtitle"># {{ $viewticket->first()->ticket }} Sorteo: {{ $viewticket->first()->day }}-{{ $viewticket->first()->hour }}</h6>
          <table class="table table-condensed table-bordered table-hover">
            <caption>Ticket {{ $viewticket->first()->ticket }}</caption>
            <thead>
              <tr>
                <th>Hora</th>
                <th>Numero</th>
                <th>Monto</th>
              </tr>
            </thead>
            <tbody>
              @foreach($viewticket as $item)
              <tr>
                <td>{{ $item->hour }}</td>
                <td class="text-center">
                  <img class="img-fluid" width="80px" src="{{ asset('img/animalitos/'.$animals[$item->number].'.png') }}" alt="{{ $animals[$item->number] }}" title="{{ $animals[$item->number] }}">
                </td>
                <td class="text-right">Bs. {{ number_format($item->amount,2,",",".") }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" class="text-right lead"><strong>Total</strong></td>
                <td class="text-right lead"><strong>{{ number_format($viewticket->sum('amount'),2,",",".") }}</strong></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection