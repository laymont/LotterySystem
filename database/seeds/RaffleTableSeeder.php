<?php

use Illuminate\Database\Seeder;
use App\Raffle;

class RaffleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $days = ['MON','TUE','WED','THU','FRI','SAT','SUN'];
     $hours = ['10:00','11:00','12:00','13:00','16:00','17:00','18:00','19:00'];

     foreach($hours as $hour)
     {
      foreach($days as $day){
        $raffle = new Raffle();
        $raffle->lottery_id = '1';
        $raffle->day = $day;
        $raffle->hour = $hour;
        $raffle->limit = '0';
        $raffle->save();
      }
    }
  }
}
