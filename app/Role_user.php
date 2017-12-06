<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'role_user';

  /**
   * Fields that can be mass assigned.
   *
   * @var array
   */
  protected $fillable = ['role_id','user_id'];

  protected $guarded = ['id'];

  /**
   * Role_user belongs to Users.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function users()
  {
    // belongsTo(RelatedModel, foreignKey = users_id, keyOnRelatedModel = id)
    return $this->belongsTo(User::class)->withTimestamps();
  }
}
