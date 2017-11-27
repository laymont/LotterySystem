<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
  use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name','description'];

    public function users()
    {
      return $this->belongsToMany(User::class)->withTimestamps();
    }
  }
