<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_info extends Model
{
  /*
  Tabla de Informacion adicional del Usuario
   */
  use SoftDeletes;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'user_info';

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['user_id','address','phone','bank_id','account','credit_card','cc_type'];

  protected $dates = ['deleted_at'];
  protected $guarded = ['id'];

  /**
   * User_info belongs to User.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    // belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    return $this->belongsTo(User::class);
  }

  /**
   * User_info belongs to Bank.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function bank()
  {
    // belongsTo(RelatedModel, foreignKey = bank_id, keyOnRelatedModel = id)
    return $this->belongsTo(Bank::class);
  }
}
