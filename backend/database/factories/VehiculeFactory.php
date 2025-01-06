<?php

namespace Database\Factories;

use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculeFactory extends Factory
{
    protected $model = Vehicule::class;

    public function definition()
    {
        return [
            'Marque' => $this->faker->company,
            'Modele' => $this->faker->word,
            'Immatriculation' => $this->faker->unique()->regexify('[A-Z]{2}-[0-9]{3}-[A-Z]{2}'),
            'DateAcquisition' => $this->faker->date,
            'Capacité' => $this->faker->numberBetween(1000, 5000),
            'TypeVéhicule' => $this->faker->randomElement(['Camion', 'Fourgon', 'SUV']),
            'HistoriquePannes' => $this->faker->sentence,
            'DateExpirationAssurance' => $this->faker->date,
        ];
    }
}

