<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {

  $animals = collect(\Config::get('constants.animals'));
  /* Mas Jugado */
  $avgPlay = \DB::table('plays')
  ->selectRaw('number, count(number) as `times`')
  ->groupBy('number')
  ->havingRaw('number > 1')
  ->orderBy('times','DESC')
  ->limit(10)
  ->get();

  foreach ($avgPlay as $value) {
    $labelPlay[] = $animals->get($value->number);
    $timesPlay[] = $value->times;
  }


  $chartjsPlay = app()->chartjs
  ->name('timesplay')
  ->type('bar')
      // ->size(['width' => 400, 'height' => 200])
  ->labels($labelPlay)
  ->datasets([
    [
      "label" => "Los 10 mas Jugados",
      'backgroundColor' => [
        'rgba(0, 255, 0, 0.3)',
        'rgba(100, 162, 235, 0.3)',
        'rgba(90, 100, 132, 0.3)',
        'rgba(255, 255, 0, 0.3)',
        'rgba(255, 0, 0, 0.3)',
        'rgba(139, 139, 0, 0.3)',
        'rgba(144, 238, 144, 0.3)',
        'rgba(0, 255, 255, 0.3)',
        'rgba(255, 99, 132, 0.3)',
        'rgba(54, 162, 235, 0.3)'
      ],
      'borderColor' => "rgba(38, 185, 154, 0.7)",
      "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
      "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
      "pointHoverBackgroundColor" => "#fff",
      "pointHoverBorderColor" => "rgba(220,220,220,1)",
      'data' => $timesPlay,
    ]
  ])
  ->options([]);

  return view('welcome', compact('chartjsPlay'));
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('confirmed/{id}', 'HomeController@confirmed')->name('confirmedpay');
Route::get('politica', function(){
  return view('/politica');
});

/* Informacion del Usuario */
Route::resource('users', 'UserinfoController');
Route::resource('roles','RoleUserController');

/* Cta Users */
Route::resource('ctausers', 'CtauserController');
Route::post('ctausers', 'CtauserController@store')->name('ctausers.store');
Route::patch('ctausers/{id}/retreats', 'CtauserController@retreats')->name('ctausers.retreats');
Route::patch('ctausers/{id}/retirement','CtauserController@retirement')->name('ctausers.retirement');
Route::get('ctausers/{user_id}/pay','CtauserController@addacount')->name('ctausers.addacount');

/* toplay */
Route::get('toplay/showtickets', 'PlayController@showtickets')->name('toplay.showtickets');
Route::resource('toplay', 'PlayController');

Route::get('results/winners', 'ResultController@winners')->name('results.winners');
Route::get('results/notifyposttime/{raffle_id}', 'ResultController@notifyposttime')->name('results.notifyposttime');
Route::get('results/statistics','ResultController@statistics')->name('results.statistics');
Route::resource('results', 'ResultController');

Route::resource('lotteries', 'LotterieController');

Route::get('raffle_id/{lottery}', 'RaffleController@raffleList');
Route::resource('raffles', 'RaffleController');

Route::resource('regains', 'RegainController');

/* Mostrar Ticket */
Route::get('ticket/{ticket}', function($ticket){
  return $ticketview = \App\Play::where('ticket', $ticket)->get();
});

/* Monto Jugado */
Route::get('_raffleamount', function (){
  $amount = \DB::table('plays')
  ->whereRaw(DB::raw('date_format(plays.date,"%Y-%m-%d") = current_date()'))
  ->groupBy(DB::raw('plays.date'))
  ->selectRaw('SUM(plays.amount) as amount')
  ->get();
  $amounts = array();
  foreach ($amount as $value) {
    array_push($amounts,$value->amount);
  }
  return array_sum($amounts);
});

/*Route::get('testsend', function(){
  $user = \App\User::find(3)->toArray();
  Mail::send('emails.welcome', $user, function($message) use ($user) {
    $message->to($user['email']);
    $message->subject('Bienvenido');
  });
});

Route::get('testemail', function(){
  return new \App\Mail\WelcomeUser(auth()->user()->name);
  // Mail::to('laymont@gmail.com')->send(new \App\Mail\WelcomeUser(auth()->user()->name));
  // return view('home');
});

Route::get('testticket', function(){
  return new \App\Mail\TicketUser();
  // Mail::to('laymont@gmail.com')->send(new \App\Mail\WelcomeUser(auth()->user()->name));
  // return view('home');
});

Route::get('testconfirm', function(){
  return new \App\Mail\confirmation_code( auth()->user()->name);
  // Mail::to('laymont@gmail.com')->send(new \App\Mail\WelcomeUser(auth()->user()->name));
  // return view('home');
});

Route::get('testregain', function(){
  return new \App\Mail\RegainsUser(auth()->user()->name);
  // Mail::to('laymont@gmail.com')->send(new \App\Mail\WelcomeUser(auth()->user()->name));
  // return view('home');
});*/