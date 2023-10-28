<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\EntrepriseSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\HistoriqueSeeder;
use Database\Seeders\InvitationSeeder;
use App\Models\Role;
use App\Models\User;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['id' => 1 , 'name' => 'admin']);
        Role::create(['id' => 2 , 'name' => 'employe']);
        User::create(['name' => 'Hamza DAYR', 'email' => 'hamzadayr@tersea.com','password' =>  bcrypt('tersea2024'),'role_id' => 1]);

        $this->call([
            UserSeeder::class,
            EntrepriseSeeder::class,
            EmployeeSeeder::class,
            InvitationSeeder::class,
            HistoriqueSeeder::class,
        ]);
    }
}
