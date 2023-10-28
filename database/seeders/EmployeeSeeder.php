<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Utilisez la factory Employee pour créer 20 enregistrements fictifs
        Employee::factory()->count(20)->create();
    }
}
