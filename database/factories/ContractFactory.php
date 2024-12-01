<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        
        return [
            'start_date' => $this->faker->dateTimeBetween('-1 year','now'),
            'end_date' => $this->faker->dateTimeBetween('now','+1 year'),
            'price_contract' => $this->faker->randomFloat(2,100,10000),
            'active_contract' => $this->faker->boolean(),
            'property_id' => \App\Models\Property::factory()
        ];
    }
}
