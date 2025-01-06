<?php

namespace Database\Factories;

use App\Models\Tarification;
use Illuminate\Database\Eloquent\Factories\Factory;

class TarificationFactory extends Factory
{
    protected $model = Tarification::class;

    public function definition()
    {
        return [
            'Type_Voyage' => $this->faker->randomElement(['National', 'International']),
            'Ville_départ' => $this->faker->city,
            'Ville_darriver' => $this->faker->city,
            'Coût' => $this->faker->randomFloat(2, 100, 10000),
            'Délai_Paiement' => $this->faker->numberBetween(15, 90),
        ];
    }
}

