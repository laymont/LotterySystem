<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\User_info;
use App\Bank;
use App\Ctauser;

class UserinfoController extends Controller
{

  /**
     * Create a new controller instance.
     *
     * @return void
     */
  public function __construct()
  {
    $this->middleware('auth');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $banks = Bank::pluck('name','id');
      return view('users.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $info = new User_info();
      $info->user_id = $request->user_id;
      $info->address = $request->address;
      $info->phone = $request->phone;
      $info->bank_id = $request->bank_id;
      $info->account = $request->account;
      $info->save();
      $id = $info->user_id;
      flash('Información Registrada')->success();
      return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $userinfo = User_info::where('user_id', '=', $id)->count();
      // dd($userinfo);
      if ( $userinfo == 0 ){
        /* No tiene informacion registrada */
        return redirect('users/create');
      }else {
        /* Si posee informacion registrada */
        $info = User_info::where('user_id', $id)->get();

        /* Saldo */
        $balance = DB::table('ctausers')
        ->where('user_id','=', Auth::id())
        ->where('confirmed',1)
        ->selectRaw('SUM(payment) AS `amount`')
        ->groupBy('user_id')
        ->get();
        //dd($balance);

        return view('users.show', compact('info', 'balance'));
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $info = User_info::where('user_id','=',$id)->get();
      $banks = Bank::pluck('name','id');
      return view('users.edit', compact('info', 'banks'));
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
      $info = User_info::findOrFail($id);
      $info->update($request->input());
      flash('Registro Actualizado')->success();
      return redirect('home');
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
