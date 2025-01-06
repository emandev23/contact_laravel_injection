<?php

namespace Database\Factories;

use App\Models\Voyage;
use App\Models\Client;
use App\Models\Chauffeur;
use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoyageFactory extends Factory
{
    protected $model = Voyage::class;

    public function definition()
    {
        return [
            'ID_Client' => Client::factory(),    // Create a Client
            'ID_Chauffeur' => Chauffeur::factory(),
            'ID_Véhicule' => Vehicule::factory(),
            'Date_Début' => $this->faker->date,
            'Date_Fin' => $this->faker->date,
            'Ville_départ' => $this->faker->city,
            'Ville_darriver' => $this->faker->city,
            'Statut' => $this->faker->randomElement(['Prévu', 'En cours', 'Terminé', 'Annulé']),
            'Type_Camion' => $this->faker->word,
            'Type_Voyage' => $this->faker->word,
            'Fournisseur' => $this->faker->company,
            'N_CMR' => $this->faker->regexify('[A-Z0-9]{10}'),
            'Scellés_Douane' => $this->faker->word,
            'Coût_Total' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}
