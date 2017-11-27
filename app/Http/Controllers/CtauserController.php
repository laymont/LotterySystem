<?php

namespace App\Http\Controllers;

use App\Ctauser;
use App\Bank;
use App\Play;
use Illuminate\Http\Request;
use DB;
use Auth;

class CtauserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ctausers = Ctauser::all();
      return view('ctausers.index',compact('ctausers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $banks = Bank::pluck('name','id');
      return view('ctausers.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->user_id);
      $abono = new Ctauser();
      $abono->user_id = $request->user_id;
      $abono->payment_day = $request->payment_day;
      $abono->payment = $request->payment;
      $abono->bank_id = $request->bank_id;
      $abono->type = $request->type;
      $abono->reference = $request->reference;
      $abono->save();

      flash()->overlay('Este registro debe confirmarlo la Administración.', 'Abono Registrado');

      return redirect('home');

    }

    /**
     * Metodo de retiro de dinero
     * @param $id de usuario y $id de cuenta del usuario
     * @return se debe restar el retiro al monto total disponible en la cuenta del usuario
     */
    public function retiro(Request $request, $id)
    {
      $retiro = Ctauser::where('user_id', $id)
      ->where('spent',0)
      ->where('payment','>=', $request->amount)
      ->first();
      if ($retiro == null) {
        flash('No puede realizar el Retiro')->overlay();
        return redirect('home');
      }
    }

    public function addacount(Request $request, $id)
    {
      if ( Auth::user()->hasRole('admin') ) {
        $pay = Ctauser::where('user_id',$request->user_id)
        ->where('spent',0)
        ->first();
        $saldo = $pay->payment;
        $abono = $saldo + $request->amount;
        $pay->payment = $abono;
      // dd($abono);
        $pay->save();
        $payticket = Play::where('user_id', $request->user_id)
        ->where('code','=', $request->code)
        ->where('pay',0)
        ->first();
        $payticket->pay = 1;
        $payticket->save();

        flash('Ticket Pagado')->success();
        return redirect('results/winners');
      }else {
        flash('Imposible realizar esta acción')->warning();
        return redirect('results/winners');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ctauser  $ctauser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     /* Mi saldo */
     /* Historial de Abonos */
     $amounts = Ctauser::where('user_id', Auth::id())
     ->orderByDesc('payment_day')
     ->get();
     if ( $amounts->isEmpty() ){
      flash()->overlay('Por favor abone saldo a la cuenta si desea Jugar', 'Sin Saldo');
      return redirect('home');
    }
    if ( $amounts[0]->confirmed == 0 and $amounts[0]->spent == 0 ){
      flash('Abono sin confirmar.')->warning();
      return redirect('home');
    }

    /* Saldo */
    $balance = DB::table('ctausers')
    ->where('user_id','=', Auth::id())
    ->where('confirmed',1)
    ->selectRaw('SUM(payment) AS `amount`')
    ->groupBy('user_id')
    ->get();
      // dd($balance);

    return view('ctausers.show', compact('amounts','balance'));
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ctauser  $ctauser
     * @return \Illuminate\Http\Response
     */
    public function edit(Ctauser $ctauser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ctauser  $ctauser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ctauser  $ctauser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ctauser $ctauser)
    {
        //
    }
  }
