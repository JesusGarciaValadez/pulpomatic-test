<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
  /**
   * A basic test example.
   *
   * @return void
   */
  public function testExample()
  {
    $user = factory( Pulpomatic\Route::class, 10 )->make();

    $this->get( 'api/v1/drivers' )
         ->seeStatusCode( 200 );
  }
}
