<?php

namespace App\Http\Controllers;
use App\Raffle;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $raffles = Raffle::where('lottery_id', $id)->orderBy('day')->orderBy('hour')->get();
      // dd($raffles);

      return view('raffles.show')->with('raffles', $raffles);
    }

    public function raffleList($lottery)
    {
      $day = \Carbon\Carbon::now('America/Caracas')->format('D'); // Dia de la Semana
      $hourActual = \Carbon\Carbon::now('America/Caracas')->format('H:m:s');

      $raffles = Raffle::where('lottery_id', $lottery)
      ->where('day',$day)
      ->where('day','=', $day)
      ->where('hour','>=', $hourActual)
      ->pluck('hour','id');
      return $raffles;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  }
