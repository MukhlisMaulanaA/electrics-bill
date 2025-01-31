<?php

namespace Database\Seeders;

use App\Models\ElectricityRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectricityRateSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    ElectricityRate::insert([
      [
        'user_id' => 2,
        'rate_code' => 'R1',
        'fixed_charge' => 50000,
        'rate_per_kwh' => 1500,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 2,
        'rate_code' => 'R2',
        'fixed_charge' => 75000,
        'rate_per_kwh' => 1500,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 2,
        'rate_code' => 'R3',
        'fixed_charge' => 100000,
        'rate_per_kwh' => 1500,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
