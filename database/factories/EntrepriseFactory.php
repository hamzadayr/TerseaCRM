<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Entreprise;

class EntrepriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Entreprise::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'logo' => 'logo.svg',
            'description' => $this->faker->text,
        ];
    }
}
