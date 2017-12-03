<?php

namespace App\Http\Controllers;

use App\Ctauser;
use App\Bank;
use App\Play;
use App\Regain;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegainsUser;

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
      $retreats = Regain::all();
      return view('ctausers.index',compact('ctausers','retreats'));
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

      alert()->warning('Abono Registrado', 'Este registro debe confirmarlo por la Administración.')->autoclose(30000);

      return redirect('home');

    }

    /**
     * Metodo de retiro de dinero
     * @param $id de usuario y $id de cuenta del usuario
     * @return se debe restar el retiro al monto total disponible en la cuenta del usuario
     */
    public function retreats(Request $request, $id)
    {
      $retirement = Ctauser::where('user_id', $id)
      ->where('spent',0)
      ->where('payment','>=', $request->amount)
      ->get();

      if($retirement->isEmpty()){
        alert()->error('Imposible Retirar', 'No dispone de Saldo para efectuar el retiro indicado');
        return redirect('home');
      }else {
        /* Registrar el retiro */
        $retirementReg = new Regain;
        $retirementReg->date = \Carbon\Carbon::now()->format('Y-m-d');
        $retirementReg->user_id = Auth::id();
        $retirementReg->amount = $request->amount;
        $retirementReg->save();

        $data = auth()->user();
        $data->toArray();

        /* Notificacion por email al usuario */
        Mail::send('emails.regainuser', ['name' => auth()->user()->name], function ($message) use($data)
        {
          $message->to($data['email'], $data['name'])->subject('Notificacion de Retiro de Saldo!');

        });

        alert()->warning('Notificación de Retiro','La notificación de retiro ha sido efectuada. Se espera por la aprobación de Administración')->autoclose(30000);
        return redirect('home');
      }

    }

    public function retirement($id)
    {
      dd($id);
    }

    public function addacount(Request $request, $id)
    {
      // dd($request->all());

      if ( Auth::user()->hasRole('admin') ) {
        $pay = Ctauser::where('user_id',$request->user_id)
        ->where('spent',0)
        ->first();
        // dd($request->user_id);
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

        alert()->success('Pago Realizado', 'Monto abonado a su cuenta')->autoclose(30000);

        return redirect('results/winners');

      }else {
        alert()->warning('Advertencia', 'Imposible realizar esta acción.')->autoclose(30000);

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

      alert()->warning('Sin saldo', 'No dispone de saldo.')->autoclose(30000);

      return redirect('home');
    }
    if ( $amounts[0]->confirmed == 0 and $amounts[0]->spent == 0 ){

      alert()->warning('Abono sin confirmar', 'Existe un abono a cuenta sin confirmación.')->autoclose(30000);

      return redirect('home');
    }

    /* Saldo */
    $balance = DB::table('ctausers')
    ->where('user_id','=', Auth::id())
    ->where('spent',0)
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
