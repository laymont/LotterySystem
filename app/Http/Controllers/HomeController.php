<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Role;
use App\Role_user;
use App\User_info;
use App\Ctauser;
use App\Lotterie;
use App\Raffle;
use App\Play;
use Alert;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $amountpending = DB::table('ctausers')
      ->join('users','ctausers.user_id','=','users.id')
      ->join('banks','ctausers.bank_id','=','banks.id')
      ->where('ctausers.confirmed','=', 0)
      ->where('spent','=',0)
      ->selectRaw('users.id, users.name AS user, ctausers.payment_day, ctausers.payment, banks.name AS bank, ctausers.type, ctausers.reference')
      ->get();

      if( Auth::user()->hasRole('admin') )
        {
          /* Si es Administrador ve todos los tickets creados (actuales */
            /* Información de los Tickets */
            $tickets = DB::table('plays')
            ->join('lotteries','plays.lottery_id','=','lotteries.id')
            ->join('raffles','plays.raffle_id','=','raffles.id')
            ->whereRaw('date_format(plays.date,"%Y-%m-%d") = current_date()')
            ->whereRaw('raffles.hour > current_time()')
            ->selectRaw('plays.date, plays.ticket, plays.user_id, lotteries.name as lottery, plays.raffle_id, raffles.day, raffles.hour, plays.number, sum(plays.amount) as `amount`, plays.code, plays.created_at')
            ->groupBy('plays.ticket')
            ->groupBy('plays.raffle_id')
            ->orderBy('plays.date','DESC')
            ->orderBy('raffles.hour','DESC')
            ->orderBy('plays.id', 'ASC')
            ->get();
          }else {
            /* Información de los Tickets */
            $tickets = DB::table('plays')
            ->join('users','plays.user_id','=','users.id')
            ->join('lotteries','plays.lottery_id','=','lotteries.id')
            ->join('raffles','plays.raffle_id','=','raffles.id')
            ->whereRaw('date_format(plays.date,"%Y-%m-%d") = current_date()')
            ->selectRaw('plays.id, plays.ticket, plays.user_id, plays.`date`, lotteries.name as `lottery` , raffles.`hour`,plays.number, sum(plays.amount) as `amount`, plays.code')
            ->groupBy('plays.ticket')
            ->groupBy('plays.raffle_id')
            ->orderBy('plays.date','DESC')
            ->orderBy('raffles.hour','DESC')
            ->orderBy('plays.id', 'ASC')
            ->get();
          }

          /* Resultados Pendientes */
          $withoutReport = DB::table('raffles')
          ->whereRaw('raffles.day =  date_format(current_date(),"%a") and raffles.hour < current_time()')
          ->whereRaw('raffles.id NOT IN(select results.raffle_id from results)')
          ->orderBy('raffles.day', 'ASC')
          ->orderBy('raffles.hour', 'ASC')
          ->get();
          // dd($withoutReport);
          /* Collect Animals para resultados */
          $animals = collect(\Config::get('constants.animals'));

          /* Autorizar a Administrador */
          /* Verificar si la informacion del Usuario esta completa */
          $info = User_info::where('user_id', Auth::user()->id)->count();
          if ( $info == 0){
            alert()->flash('Informacion de Usuario Incompleta!', 'warning')->autoclose(30000);
            $request->user()->authorizeRoles(['user', 'admin']);
            return view('home', compact('amountpending', 'tickets','withoutReport','animals'));
          }else {
            $request->user()->authorizeRoles(['user', 'admin']);
            return view('home', compact('amountpending', 'tickets','withoutReport','animals'));
          }

        }

        public function confirmed($id)
        {
          $amount = Ctauser::where('user_id', $id)
          ->where('confirmed','=',0)
          ->first();
          $amount->confirmed = '1';
          $amount->save();

          alert()->success('Confirmado', 'Abono confirmado')->autoclose(30000);
          return redirect('home');
        }


    /*public function someAdminStuff(Request $request)
    {
      $request->user()->authorizeRoles('manager');
      $admin = true;
      return view('home')->with('admin');
    }*/

    public function current_tickets()
    {
      // if( Auth::user()->hasRole('admin') )
    }
  }
