@extends('layouts.ticket')

@section('content')

<div class="container">
  <div class="row">
    <div class="lg-4">
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
            <td class="text-center">{{ $animals[$item->number] }}</td>
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

@endsection