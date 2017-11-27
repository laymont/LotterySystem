<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtausersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctausers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('payment_day');
            $table->decimal('payment',10,2);
            $table->integer('bank_id');
            $table->enum('type', ['Deposito','Transferencia']);
            $table->string('reference',20);
            $table->boolean('confirmed');
            $table->boolean('spent');
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
        Schema::dropIfExists('ctausers');
    }
}
