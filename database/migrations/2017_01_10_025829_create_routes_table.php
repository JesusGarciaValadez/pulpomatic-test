<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create( 'routes', function ( Blueprint $table )
    {
      $table->increments( 'id' );

      $table->text( 'driver' );
      $table->text( 'client' );
      $table->text( 'origin' );
      $table->text( 'destination' );

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists( 'routes' );
  }
}
