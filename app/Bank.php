<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
  /*
  tabla de Bancos
   */
  use SoftDeletes;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'banks';

  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['code','name'];
}
