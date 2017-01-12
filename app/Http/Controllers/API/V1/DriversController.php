<?php

namespace Pulpomatic\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Pulpomatic\Http\Controllers\Controller;

use Pulpomatic\Route;

class DriversController extends Controller
{
  public function quantity( $quantity )
  {
    $addresses = Route::take( $quantity )
                      ->get();

    return $addresses;
  }
}
