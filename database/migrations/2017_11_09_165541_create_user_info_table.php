<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('address')->nulleable();
            $table->string('phone')->nulleable();
            $table->integer('bank_id')->nulleable();
            $table->string('account',30)->nulleable();
            $table->enum('credit_card',['Y','N'])->default('N');
            $table->enum('cc_type',['Visa','MasterCard','AmericaExpress','Other','None'])->default('None');
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
        Schema::dropIfExists('user_info');
    }
}
