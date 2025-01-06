<?php

namespace Database\Factories;

use App\Models\Chauffeur;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChauffeurFactory extends Factory
{
    protected $model = Chauffeur::class;

    public function definition()
    {
        return [
            'Nom' => $this->faker->lastName,
            'Prénom' => $this->faker->firstName,
            'Numéro_permis' => $this->faker->regexify('[A-Z0-9]{8}'),
            'Contact' => $this->faker->phoneNumber,
            'Disponibilité' => $this->faker->boolean,
        ];
    }
}

