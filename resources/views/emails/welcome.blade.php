@component('mail::message')
# Hola, {{ $name }}, bienvenido a Mundo Animalitos

<h3>Apuesta y Cobra.. Facil y Sencillo..</h3>

<p>Ponemos a su disposicion nuestro sistema de juego en linea, para que se divierta apostando con el juego del momento.<br> Que nos diferencias de las otras paginas de juegos, nuestro monto limite de apuesta....</p>

<p><strong>Desde la comodidad de tu hogar.. Jugamos?..</strong><br>
No tienes porque hacer largas colas para poder hacer tus jugadas en la Ruleta, desde la comidad de tu hogar; desde la PC, Tablet o Teléfono Inteligente podras hacer tus jugadas.</p>


@component('mail::button', ['url' => 'https://www.mundoanimalitos.com'])
Comience a Jugar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
