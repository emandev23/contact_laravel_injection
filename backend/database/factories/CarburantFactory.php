<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
namespace Database\Factories;

use App\Models\Carburant;
use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarburantFactory extends Factory
{
    protected $model = Carburant::class;

    public function definition()
    {
        return [
            'VéhiculeID' => Vehicule::factory(),
            'Quantité' => $this->faker->numberBetween(10, 500),
            'Coût' => $this->faker->randomFloat(2, 100, 5000),
            'Date' => $this->faker->date,
            'Consommation' => $this->faker->randomFloat(2, 5, 15),
        ];
    }
}

