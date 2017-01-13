<?php

namespace Pulpomatic;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'driver', 'client', 'origin', 'destination'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id', 'created_at', 'updated_at'
  ];
}
