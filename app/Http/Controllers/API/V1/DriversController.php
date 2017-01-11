<?php

namespace Pulpomatic\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Pulpomatic\Http\Controllers\Controller;

use Pulpomatic\Http\Requests\RoutesQuantityRequest;

use Pulpomatic\Route;

class DriversController extends Controller
{
  public function quantity( RoutesQuantityRequest $request )
  {
    $addresses = Route::take( $request->quantity )
                      ->get();

    return $addresses;
  }
}
