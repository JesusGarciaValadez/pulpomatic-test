<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get( '/user', function ( Request $request )
{
  return $request->user();
} )->middleware( 'auth:api' );

Route::group( [ 'middleware' => [ 'throttle' ], 'prefix' => 'v1/' ], function()
{
  Route::get( 'drivers/{quantity?}', [ 'as' => 'drivers', 'uses' => 'API\V1\DriversController@quantity' ] );
} );
