<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use App\Models\User;
use App\Models\Entreprise;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first(); // Récupère un utilisateur existant de manière aléatoire
        $entreprise = Entreprise::inRandomOrder()->first(); // Récupère une entreprise existant de manière aléatoire

        return [
            'user_id' => $user->id, // L'ID de l'utilisateur associé à cet employé
            'entreprise_id' => $entreprise->id, // L'ID de l'entreprise associé à cet employé
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date,
        ];
    }
}