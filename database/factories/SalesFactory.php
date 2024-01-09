<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            // Define your model's attributes and their default values
            'nik' => $this->faker->unique()->numerify('###########'),
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date,
            'alamat_ktp' => $this->faker->address,
            'alamat_domisili' => $this->faker->address,
            'nomor_handphone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'username' => $this->faker->userName,
            'password' => bcrypt('password'), // Use bcrypt() to hash the password
        ];
    }
}
