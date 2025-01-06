<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'Nom' => $this->faker->name,
            'Adresse' => $this->faker->address,
            'Contact' => $this->faker->phoneNumber,
            'Email' => $this->faker->unique()->safeEmail,
            'Type_Client' => $this->faker->randomElement(['Particulier', 'Entreprise']),
        ];
    }
}
