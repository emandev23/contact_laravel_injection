<?php

namespace Database\Factories;

use App\Models\Facture;
use App\Models\Voyage;
use Illuminate\Database\Eloquent\Factories\Factory;

class FactureFactory extends Factory
{
    protected $model = Facture::class;

    public function definition()
    {
        // Create a Voyage instance with its Client
        $voyage = Voyage::factory()->create();

        return [
            'ID_Client' => $voyage->ID_Client, // Ensure Client ID comes from the Voyage
            'ID_Voyage' => $voyage->id,        // Link Facture to the Voyage
        ];
    }
}
