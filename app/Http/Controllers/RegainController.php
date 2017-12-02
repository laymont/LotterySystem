<?php

namespace App\Http\Controllers;

use App\Regain;
use App\User;
use App\User_info;
use App\Ctauser;
use DB;
use Illuminate\Http\Request;

class RegainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $regains = Regain::where('send',0)->with('users','usersinfo')->get();
      return view('regains.index', compact('regains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('regains.create');
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
     * @param  \App\Regain  $regain
     * @return \Illuminate\Http\Response
     */
    public function show(Regain $regain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Regain  $regain
     * @return \Illuminate\Http\Response
     */
    public function edit(Regain $regain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Regain  $regain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regain $regain)
    {
      $discount = Ctauser::where('user_id',$request->user_id)
      ->where('spent',0)
      ->get();
      if($discount->count() === 1){
        $balance = $discount[0]->payment - $request->amount;
        if($balance > 0){
          $discount[0]->payment = $balance;
          $discount[0]->save();

          $sendpay = Regain::findOrFail($request->id);
          $sendpay->send = 1;
          $sendpay->save();

          alert()->success('Confirmado','Se registro el Reintegro al Usuario')->autoclose(30000);
          return redirect('regains');

        }else {
          alert()->error('Imposible hacer este reintegro','El usuario no posee Saldo en cuenta para hacer este retiro')->autoclose(30000);
          return redirect('regains');
        }
      }else {
        alert()->error('Imposible hacer este reintegro','El usuario posee mas de un registro de Abono activo. Se debe normalizar la data.')->autoclose(30000);
        return redirect('regains');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regain  $regain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regain $regain)
    {
        //
    }
  }
