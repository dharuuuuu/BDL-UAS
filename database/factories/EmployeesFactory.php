<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;



class EmployeesFactory extends Factory
{
    public function definition()
    {
        $randomNumber = $this->faker->numberBetween(1, 8);

        // Round the random number to the nearest million
        $roundedNumber = round($randomNumber * 1000000);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'join_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'salary' => $roundedNumber,
            'age' => rand(20,50),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'position' => $this->faker->randomElement(['Junior Web', 'Senior Web', 'Designer']),
        ];
    }
}
