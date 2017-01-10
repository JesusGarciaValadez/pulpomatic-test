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
    'driver', 'client', 'distance', 'time'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
