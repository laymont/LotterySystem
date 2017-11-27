<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Result extends Model
{
  /**
   * Resultados
   */
  use SoftDeletes;
  use FormAccessible;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'results';
  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['date','lottery_id','raffle_id','result'];

  /**
   * Result belongs to Lotterie.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function lotterie()
  {
    // belongsTo(RelatedModel, foreignKey = lotterie_id, keyOnRelatedModel = id)
    return $this->belongsTo(Lotterie::class, 'lottery_id');
  }

  /**
   * Result belongs to Raffle.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function raffle()
  {
    // belongsTo(RelatedModel, foreignKey = raffle_id, keyOnRelatedModel = id)
    return $this->belongsTo(Raffle::class);
  }
}
