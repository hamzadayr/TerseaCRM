<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entreprise;


class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Utilisez la factory Entreprise pour créer 10 enregistrements fictifs
        Entreprise::factory()->count(10)->create();
    }
}
