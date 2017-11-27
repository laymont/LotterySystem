<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Regain extends Model
{
  /*
  Tabla de registro de retiro de dinero
   */
  use SoftDeletes;
  use FormAccessible;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'regains';
  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['date','user_id','amount'];
}
