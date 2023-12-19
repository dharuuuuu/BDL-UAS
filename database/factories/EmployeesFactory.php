<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\id_ID\Person;

class EmployeesFactory extends Factory
{
    public function definition()
    {
        $randomNumber = $this->faker->numberBetween(1, 8);

        // Round the random number to the nearest million
        $roundedNumber = round($randomNumber * 1000000);

        // Set the Faker locale to Indonesian
        $this->faker->addProvider(new Person($this->faker));

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'join_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'salary' => $roundedNumber,
            'age' => rand(20, 50),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'position' => $this->faker->randomElement(['Junior Web', 'Senior Web', 'Designer']),
        ];
    }
}
