<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plays', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('date');
            $table->string('ticket',100)->index();
            $table->integer('user_id')->index();
            $table->integer('lottery_id')->index();
            $table->integer('raffle_id')->index();
            $table->integer('number')->index();
            $table->decimal('amount', 10, 0);
            $table->string('code',100);
            $table->integer('discounted')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plays');
    }
}
