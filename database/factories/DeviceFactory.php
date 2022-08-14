<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->uuid(),
            'model' => fake()->name(),
            'brand' => fake()->name(),
            'release_date' => fake()->date('Y/m'),
            'os' => fake()->name(),
            'is_new' => fake()->boolean(),
            'received_datatime' => fake()->date(),
            'created_datetime' => fake()->date(),
            'update_datetime' => fake()->date(),
        ];
    }
}
