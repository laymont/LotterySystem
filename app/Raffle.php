<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Raffle extends Model
{
  /*
  Tablas de Sorteos disponibles
   */

   use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'raffles';
  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['lottery_id','day','hour','limit'];

  /**
   * Raffle belongs to Lotteries.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function lotteries()
  {
    // belongsTo(RelatedModel, foreignKey = lotteries_id, keyOnRelatedModel = id)
    return $this->belongsTo(Lotterie::class,'lottery_id');
  }
}
