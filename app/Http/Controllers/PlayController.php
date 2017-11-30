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
      $lottery_list = Lotterie::select('name','id')->get();
      $day = \Carbon\Carbon::now('America/Caracas')->format('D'); // Dia de la Semana
      $hourActual = \Carbon\Carbon::now('America/Caracas')->format('H:m:s');

      $raffles = Raffle::where('lottery_id', 1)
      ->where('day','=', $day)
      // ->where('hour','>=', $hourActual)
      ->select('id','hour')
      ->get();

      // $raffles = $raffles->toJson();

      return view('toplay.play', compact('lottery_list','raffles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      dd( $request->ticket );

      // validate
      $validator = $request->validate([
        'ticket' => 'required'
      ]);

      $numberTicket = time() . '-' . mt_rand(0,38);

      // dd( $request->input() );

      $json = json_decode($request->input('ticket'));
      /* comprobar si tiene saldo suficiente para jugar */
      // dd($json);
      $total = array();
      foreach ($json as $value) {
        $total[] = $value->amount;
      }
      $total = array_sum($total);
      $ctauser = Ctauser::where('spent',0)
      ->where('user_id', Auth::id())
      ->select('payment')
      ->first();

      // dd($ctauser->payment);

      if ($total > $ctauser->payment) {
        /* No tiene saldo para realizar la apuesta */
        alert()->error('Error', 'No tiene saldo suficiente para realizar esta apuesta')->autoclose(30000);
        return redirect('home');
      }else {
        /* Puede realizar la apuesta; se descuenta el monto */
        $acount = Ctauser::where('spent', 0)
        ->where('user_id', Auth::id())
        ->select('id', 'payment')
        ->first();

        $rest = $acount->payment - $total;
        $discount = Ctauser::where('user_id', Auth::id())
        ->where('spent', 0)
        ->first();
        $discount->payment = $rest;
        $discount->save();
      }

      foreach ($json as $value) {
        $play = new Play();
        $play->date = $value->date;
        $play->ticket = $numberTicket;
        $play->user_id = $value->user;
        $play->lottery_id = $value->lottery;
        $play->raffle_id = $value->raffle;
        $play->number = $value->number;
        $play->amount = $value->amount;
        $play->code = $value->lottery . '-' . $value->raffle . '-' . $value->number . '-' . $numberTicket;
        /* Descontar el monto jugado */

        $play->save();
      }

      alert()->success('Registro Correcto', 'Ticket Registrado')->autoclose(30000);
      return redirect('home');
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
