<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
   
    return [
        //

        'first_name' => $this->faker->firstName,
        'last_name' => $this->faker->lastName,
        'dob' => $this->faker->date,
        'email' => $this->faker->unique()->safeEmail,
        'address' => $this->faker->address,
        'phone' => $this->faker->numberBetween(90000000,99999999),
        'delete_at' => $this->faker->date,

        //'amount' => $this->faker->randomFloat(2, 0, 100),
        //'payment' => $this->faker->numberBetween(1, 5),
    ];
});
