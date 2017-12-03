<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
@component('mail::message')
# Ticket #

<table class="table table-condensed table-bordered">
  <caption>Ticket</caption>
  <thead>
    <tr>
      <th>Sorteo</th>
      <th>Numero</th>
      <th>Monto</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center">data</td>
      <td class="text-center">data</td>
      <td class="text-right">data</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="2" class="text-right">Total:</td>
      <td></td>
    </tr>
  </tfoot>
</table>



Gracias por preferirnos.<br>
{{ config('app.name') }}
@endcomponent
