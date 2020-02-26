<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        "codigo" => str_random(6),
        "nombre" => $faker->name,
        "salarioDolares" => $faker->randomFloat,
        "salarioPesos" => $faker->randomFloat,
        "direccion" => $faker->address,
        "estado" => $faker->country,
        "ciudad" => $faker->city,
        "telefono" => $faker->phonenumber,
        "correo" => $faker->unique()->safeEmail
    ];
});
