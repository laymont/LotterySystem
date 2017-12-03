<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Ctauser;
use App\Play;
use App\Lotterie;
use App\Raffle;
use App\Result;
use Illuminate\Http\Request;
use Alert;

class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /* Saldo */
      $balance = DB::table('ctausers')
      ->where('user_id','=', Auth::id())
      ->selectRaw('SUM(payment) AS `amount`')
      ->groupBy('user_id')
      ->get();
      if ($balance->isEmpty()) {

        alert()->warning('Advertencia', 'Sin saldo para realizar apuestas.')->autoclose(30000);

        return redirect('home');
      }

      $day = \Carbon\Carbon::now('America/Caracas')->format('D'); // Dia de la Semana

      $hourActual = \Carbon\Carbon::now('America/Caracas')->format('H:m:s');
      //dd($hourActual);
      $lottery = Lotterie::pluck('name','id');

      if (\Carbon\Carbon::now()->format('H:m:s') > '19:05:00') {
        /* Sorteos segun dia y hora */
        $raffles = Raffle::where('day',$day)
        ->where('day','=', $day)
        // ->where('hour','>=', $hourActual)
        ->pluck('hour','id');
      }else {
        /* Sorteos segun loteria dia y hora */
        $raffles = Raffle::where('day',$day)
        ->where('day','=', $day)
        ->where('hour','>=', $hourActual)
        ->pluck('hour','id');
      }
      /*if ($raffles->isEmpty()){
        flash('No hay sorteos por efectuarse')->overlay();
        return redirect('home');
      }*/

      return view('toplay.index', compact('lottery', 'raffles', 'balance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $lottery_list = Lotterie::pluck('name','id');
      $day = \Carbon\Carbon::now('America/Caracas')->format('D'); // Dia de la Semana

      $hourActual = \Carbon\Carbon::now('America/Caracas');
      $hourActual->minute = 00;
      $hourActual->second = 00;
      $hourActual->addHour();
      $hourActual->subMinutes(5); //hora del sorteo menos 5 min$hourActual

      $numberTicket = time() . '-' . mt_rand(0,38);

      $raffles = Raffle::where('lottery_id', 1)
      ->where('day','=', $day)
      ->where('hour','>=', $hourActual->toTimeString())
      ->pluck('hour','id');

      if($raffles->isEmpty()){
        alert()->error('Sin Sorteo', 'No hay sorteos disponibles para jugar')->autoclose(30000);
        return redirect('home');
      }

      // $raffles = $raffles->toJson();

      return view('toplay.play', compact('lottery_list','raffles','numberTicket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /* Make Array */
      $ticket = collect(); // Nueva colecion para ticket
      $number = explode(",",$request->numbers); // Numeros Jugados
      $amount = explode(",",$request->amounts); // Montos Apostados


      /* Creo la coleccion con $Request */
      for ($i = 0; $i <=count($number)-1 ; $i++) {
        $ticket->push(['date'=>\Carbon\Carbon::now()->format('Y-m-d h:m:s'),'ticket'=>$request->ticket,'user_id'=>$request->user_id,'lottery_id'=>$request->lottery_id,'raffle_id'=>$request->raffleid,'number'=>$number[$i],'amount'=>$amount[$i],'code'=>$request->lottery_id.'-'.$request->raffleid.'-'.$number[$i].'-'.$request->ticket]);
      }

      /* Monto total de la Apuesta */
      $betAmount = $ticket->sum('amount');

      /* Dato de las cuenta y abonos del usuario */
      $ctausers = Ctauser::where('spent',0)
      ->where('user_id', Auth::id())
      ->get();

      /* Sumar los registros */
      $totalAmount = $ctausers->sum('payment'); // <-Saldo Total
      /* Cantidad de Registros */
      $totalRegisterAmount = $ctausers->count(); // <-Cantidad de Registros

      /* Saldo restante */
      $finalAmount = $totalAmount - $betAmount; // <-(Saldo - Apuesta)

      if ($totalRegisterAmount == 1) {
        /* Si solo posee un registro en CTAUSERS */
        $ctausers[0]->payment = $finalAmount; // <-actualizando el ult registro a saldo definitivo
        $ctausers[0]->save();
        /* registrar ticket */
        for ($i = 0; $i <=count($ticket)-1 ; $i++) {
          $regTicket = new Play;
          $regTicket->date = $ticket[$i]['date'];
          $regTicket->ticket = $ticket[$i]['ticket'];
          $regTicket->user_id = $ticket[$i]['user_id'];
          $regTicket->lottery_id = $ticket[$i]['lottery_id'];
          $regTicket->raffle_id = $ticket[$i]['raffle_id'];
          $regTicket->number = $ticket[$i]['number'];
          $regTicket->amount = $ticket[$i]['amount'];
          $regTicket->code = $ticket[$i]['code'];
          $regTicket->save();
        }
        /* Fin del Proceso */
        alert()->success('Registro Correcto', 'Ticket Registrado')->autoclose(30000);
        return redirect('home');

      }else if ($totalRegisterAmount > 1) {
        /* Posee mas de un registro*/
        $lastRegCtausers = $ctausers->last();
        $lastRegCtausers->payment = $finalAmount; // <-actualizando el ult registro a saldo definitivo
        $lastRegCtausers->save();
        $ctausers->pop();
        $ctausers->all();
        /* Agotar los registros restantes */
        for ($i = 0; $i <=count($ctausers)-1 ; $i++) {
          $ctausers[$i]->spent = 1;
          $ctausers[$i]->save();
        }

        /* registrar ticket */
        for ($i = 0; $i <=count($ticket)-1 ; $i++) {
          $regTicket = new Play;
          $regTicket->date = $ticket[$i]['date'];
          $regTicket->ticket = $ticket[$i]['ticket'];
          $regTicket->user_id = $ticket[$i]['user_id'];
          $regTicket->lottery_id = $ticket[$i]['lottery_id'];
          $regTicket->raffle_id = $ticket[$i]['raffle_id'];
          $regTicket->number = $ticket[$i]['number'];
          $regTicket->amount = $ticket[$i]['amount'];
          $regTicket->code = $ticket[$i]['code'];
          $regTicket->save();
        }
        /* Fin del Proceso */
        alert()->success('Registro Correcto', 'Ticket Registrado')->autoclose(30000);
        return redirect('home');
      }else {
        /* Error */
        alert()->error('ERROR', 'Imposible registrar su jugada. Comuniquese con la Administración')->autoclose(30000);
        return redirect('home');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function show(Play $play, $ticket)
    {
      $animals = collect(\Config::get('constants.animals'));

      $viewticket = DB::table('plays')
      ->join('raffles','plays.raffle_id','=','raffles.id')
      ->where('ticket','=',$ticket)
      ->selectRaw('plays.ticket, raffles.day, raffles.hour, plays.number, plays.amount')
      ->get();
      // dd($viewticket);
      return view('toplay.show', compact('viewticket','animals'));
    }

    public function raffleamount()
    {
      $raffleamount = DB::table('plays')
      ->whereRaw('date_format(plays.date,"%Y-%m-%d") = current_date()')
      ->groupBy('plays.date')
      ->selectRaw('sum(plays.amount) as amount')
      ->get();
      return $raffleamount;
    }

    public function showtickets()
    {
      $tickets = DB::table('plays')
      ->join('lotteries','plays.lottery_id','=','lotteries.id')
      ->join('raffles','plays.raffle_id','=','raffles.id')
      ->whereRaw('date_format(date,"%Y-%m-%d") >= current_date()')
      ->selectRaw('plays.date, plays.ticket, plays.user_id, lotteries.name as lottery, raffles.hour, plays.number, plays.amount, plays.code, plays.pay')
      // ->groupBy('plays.ticket')
      ->orderBy('plays.date', 'DESC')
      ->get();
      $animals = collect(\Config::get('constants.animals'));
      return view('toplay.showtickets', compact('tickets','animals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function edit(Play $play)
    {
      return 'toplay.edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Play $play)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Play  $play
     * @return \Illuminate\Http\Response
     */
    public function destroy(Play $play)
    {
        //
    }
  }
