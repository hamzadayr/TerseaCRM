<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Historique;


class HistoriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Historique::factory()->count(10)->create();
    }
}
