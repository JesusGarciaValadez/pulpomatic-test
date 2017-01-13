<?php

namespace Pulpomatic\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Pulpomatic\Http\Controllers\Controller;

use Pulpomatic\Route;

class DriversController extends Controller
{
  public function quantity( $quantity = 1 )
  {
    $addresses = Route::take( $quantity )
                      ->get();

    return $addresses;
  }
}
