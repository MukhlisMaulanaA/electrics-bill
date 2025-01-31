<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ElectricityRate>
 */
class ElectricityRateFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'user_id' => User::factory(), // Buat user admin otomatis jika belum ada
      'rate_code' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{2}'), // Misal: "AB12"
      'fixed_charge' => $this->faker->randomElement([50000, 75000, 100000]), // Tarif tetap
      'rate_per_kwh' => $this->faker->numberBetween(1000, 3000), // Tarif per kWh
    ];
  }
}
