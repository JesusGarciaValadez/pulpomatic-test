<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define( Pulpomatic\User::class, function ( Faker\Generator $faker )
{
  static $password;

  return [
    'name'            => $faker->name,
    'email'           => $faker->unique()->safeEmail,
    'password'        => $password ?: $password = bcrypt( 'secret' ),
    'remember_token'  => str_random(10),
  ];
} );

$factory->define( Pulpomatic\Route::class, function ( Faker\Generator $faker )
{
  static $password;

  return [
    'driver'      => $faker->name,
    'client'      => $faker->company,
    'origin'      => $faker->latitude( -90, 90 ) . ', ' . $faker->longitude( -180, 180 ),
    'destination' => $faker->latitude( -90, 90 ) . ', ' . $faker->longitude( -180, 180 ),
    'time'        => $faker->time( 'H:i', 'now' )
  ];
} );
