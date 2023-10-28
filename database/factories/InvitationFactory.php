<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Entreprise;

class InvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Invitation::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first(); // Récupère un utilisateur existant de manière aléatoire
        $entreprise = Entreprise::inRandomOrder()->first(); // Récupère une entreprise existant de manière aléatoire
        return [
            'user_id' => $user->id,
            'entreprise_id' => $entreprise->id, 
            'email' => $this->faker->unique()->safeEmail,
            'token' => Str::random(20),
            'status' => 'pending',
        ];
    }
}
