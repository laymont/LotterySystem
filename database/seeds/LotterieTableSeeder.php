<?php

use Illuminate\Database\Seeder;
use App\Lotterie;

class LotterieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lottery = new Lotterie();
        $lottery->name = 'Ruleta Activa';
        $lottery->relation = '3/1';
        $lottery->min = '100';
        $lottery->max = '20000';
    }
}
