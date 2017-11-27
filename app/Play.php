<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Play extends Model
{
  /*
  Tabla de Apuestas|Tickets de Loteria
   */
  use SoftDeletes;
  use FormAccessible;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'plays';
  protected $dates = ['deleted_at'];
  protected $guarded = ['id','discounted','pay'];
  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['ticket','user_id','date','lottery_id','raffle_id','number','amount','code'];

  /**
   * Play belongs to Lotteries.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function lotteries()
  {
    // belongsTo(RelatedModel, foreignKey = lotteries_id, keyOnRelatedModel = id)
    return $this->belongsTo(Lotterie::class,'lottery_id');
  }

  /**
   * Play belongs to Raffles.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function raffles()
  {
    // belongsTo(RelatedModel, foreignKey = raffles_id, keyOnRelatedModel = id)
    return $this->belongsTo(Raffle::class,'raffle_id','id');
  }
}
