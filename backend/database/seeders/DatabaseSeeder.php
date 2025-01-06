<?php

namespace Database\Seeders;

use App\Models\Voyage;
use Illuminate\Database\Seeder;
use App\Models\Tarification;
use App\Models\User;
use App\Models\Facture;
use App\Models\Chauffeur;
use App\Models\Vehicule;
use App\Models\Carburant;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed clients and related modelss
        Chauffeur::factory(10)->create();
        Vehicule::factory(10)->create();
        Tarification::factory(10)->create();
        Facture::factory(10)->create();
        Carburant::factory(10)->create();
        Voyage::factory(10)->create();
        User::factory(10)->create();

    }
}
