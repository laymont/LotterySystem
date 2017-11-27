<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Ctauser extends Model
{
  /*
  Tabla de Abonos o Aportes de Dinero a la Banca
  */
  use SoftDeletes;
  use FormAccessible;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'ctausers';
  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['user_id','payment_day','payment','bank_id','type','reference','confirmed','spent'];

  /**
   * Ctauser belongs to User.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    // belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    return $this->belongsTo(User::class);
  }


  /**
   * Ctauser belongs to Banks.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function bank()
  {
    // belongsTo(RelatedModel, foreignKey = bank_id, keyOnRelatedModel = id)
    return $this->belongsTo(Bank::class);
  }
}
