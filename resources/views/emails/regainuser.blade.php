<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
# Mundo Animalitos

Sr/Sra {{ auth()->user()->name }}, hemos recibido una notificación de retiro de saldo abonado en su cuenta.

La Administración pronto procesara su solicitud, y le indicar cuando se efectue el abono a su cuenta Bancaria que aparece registrada en su información de Registro.

Gracias,<br>
{{ config('app.name') }}
