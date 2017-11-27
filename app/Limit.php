<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Limit extends Model
{
  /*
  Tabla de Limitantes para Loterias y Apuestas
   */

  use SoftDeletes;
  use FormAccessible;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'limits';
  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['date','lottery_id','raffle_id','user_id','amount'];
    //
}
