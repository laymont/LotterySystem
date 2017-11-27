<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Lotterie extends Model
{
  /*
  Tablas de Loterias Disponibles para Jugar
   */
  use SoftDeletes;
  use FormAccessible;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'lotteries';
  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['name','relation','min','max'];
}
