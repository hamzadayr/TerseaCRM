<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Historique;


class HistoriqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Historique::class;

    public function definition()
    {
        return [
            'action_message' => " / Admin ".$this->faker->name."a invité l'employé ".$this->faker->name." à joindre la société ".$this->faker->company,
        ];
    }
}
