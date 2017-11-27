<?php

namespace App\Http\Controllers;
use DB;

use App\Result;
use App\Lotterie;
use App\Raffle;
use App\Play;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Alert;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $results = Result::all()->sortByDesc('date');
      $animals = collect(\Config::get('constants.animals'));
      return view('results.index', compact('results', 'animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      /* Comprobar si*/
      if ( \Carbon\Carbon::now()->format('H') > '20' || \Carbon\Carbon::now()->format('H') < '7' ) {
        alert()->warning('Advertencia', 'Intenta registrar un resultado fuera del horario permitido')->autoclose(30000);
        return redirect('home');
      }

       // dd( \Carbon\Carbon::now()->format('H') );
      $lottery = Lotterie::pluck('name','id');
      $raffle = Raffle::where('day','=', \Carbon\Carbon::now()->format('D'))
      // ->where('hour','>=', \Carbon\Carbon::now()->format('H:m:s'))
      ->pluck('hour','id');
      // ->get();
      // dd($raffle);
      /* Resultados Pendientes */
      $withoutReport = DB::table('raffles')
      ->whereRaw('raffles.day =  date_format(current_date(),"%a") and raffles.hour < current_time()')
      ->whereRaw('raffles.id NOT IN(select results.raffle_id from results)')
      ->orderBy('raffles.day', 'ASC')
      ->orderBy('raffles.hour', 'ASC')
      ->get();

      return view('results.create', compact('lottery','raffle','withoutReport'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->all());
      $result = new Result();
      $result->date = $request->date;
      $result->lottery_id = $request->lottery_id;
      $result->raffle_id = $request->raffle_id;
      $result->result = $request->result;
      $result->save();
      flash('Resultado registrado')->success();
      return redirect('results');
    }

    /**
     * Notificación fuera de tiempo
     * @param $raffle_id
     * @return create result
     */

    public function notifyposttime($raffle_id)
    {
       // dd( \Carbon\Carbon::now()->format('H') );
      $lottery = Lotterie::pluck('name','id');
      $raffle = Raffle::where('day','=', \Carbon\Carbon::now()->format('D'))->where('id', $raffle_id)
      // ->where('hour','>=', \Carbon\Carbon::now()->format('H:m:s'))
      ->pluck('hour','id');
      /* Resultados Pendientes */
      $withoutReport = DB::table('raffles')
      ->whereRaw('raffles.day =  date_format(current_date(),"%a") and raffles.hour < current_time()')
      ->whereRaw('raffles.id NOT IN(select results.raffle_id from results)')
      ->orderBy('raffles.day', 'ASC')
      ->orderBy('raffles.hour', 'ASC')
      ->get();
      return view('results.notifyposttime', compact('lottery', 'raffle','withoutReport'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    public function winners()
    {
      $winners = DB::table('plays')->join('results','plays.raffle_id','=','results.raffle_id')
      ->whereRaw('results.result = plays.number and date_format(results.date,"%Y-%m-%d") = current_date')->selectRaw('plays.id, results.date, plays.ticket, plays.code, plays.user_id, plays.lottery_id, plays.raffle_id as playraffle,plays.number, plays.amount,results.lottery_id as resultlottery, results.raffle_id as resultraffle, results.result,(plays.amount * 3) as gain, plays.pay')
      ->get();

      return view('results.winners', compact('winners'));
    }

    public function statistics()
    {
      $animals = collect(\Config::get('constants.animals'));

      /* Mas veces en Resultados */
      $avg = DB::table('results')
      ->selectRaw('result, COUNT(result) AS `times`')
      ->groupBy('result')
      ->havingRaw('`times` > 1')
      ->orderBy('times','DESC')
      ->limit(10)
      ->get();

      foreach ($avg as $key => $value) {
        $label[] = $animals->get($value->result);
        $times[] = $value->times;
      }

      $chartjs = app()->chartjs
      ->name('times')
      ->type('bar')
      // ->size(['width' => 400, 'height' => 200])
      ->labels($label)
      ->datasets([
        [
          "label" => "Los 10 mas Salidos",
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
          'data' => $times,
        ]
      ])
      ->options([]);

      /* Mas Jugado */
      $avgPlay = DB::table('plays')
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

      return view('results.statistics', compact('avg','chartjs','chartjsPlay'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
  }
