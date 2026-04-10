<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = app(\Faker\Generator::class);
        return [
            'matricule' => $faker->unique()->bothify('STUD-####'),
            'nom' => $faker->lastName,
            'prenom' => $faker->firstName,
            'sexe' => $faker->randomElement(['M', 'F']),
            'date_naissance' => $faker->date('Y-m-d', '-10 years'),
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'status' => 'active',
        ];
    }
}
