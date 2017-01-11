<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = factory( Pulpomatic\Route::class, 100 )->create();
  }
}
