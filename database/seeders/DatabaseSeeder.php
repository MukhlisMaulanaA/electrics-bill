<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\ElectricityRate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    // User::factory()->create([
    //   'name' => 'Admin',
    //   'email' => 'admin@example.com',
    //   'password' => bcrypt('password'),
    //   'is_admin' => True,
    // ]);

    $this->call([
      UserSeeder::class,
      // ElectricityRateSeeder::class,
    ]);

    // Buat user customer
    $customerUser = User::create([
      'name' => 'Fulan',
      'email' => 'fulan@example.com',
      'password' => bcrypt('password'),
      'is_admin' => false,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    $electricityRate1 = ElectricityRate::create([
      'user_id' => 2,
      'rate_code' => 'R1',
      'fixed_charge' => 50000,
      'rate_per_kwh' => 1500,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
    // $electricityRate2 = ElectricityRate::create([
    //   'user_id' => 2,
    //   'rate_code' => 'R2',
    //   'fixed_charge' => 75000,
    //   'rate_per_kwh' => 1500,
    //   'created_at' => now(),
    //   'updated_at' => now(),
    // ]);
    // $electricityRate3 = ElectricityRate::create([
    //   'user_id' => 2,
    //   'rate_code' => 'R3',
    //   'fixed_charge' => 100000,
    //   'rate_per_kwh' => 1500,
    //   'created_at' => now(),
    //   'updated_at' => now(),
    // ]);

    // Buat data customer terkait dengan user customer
    Customer::create([
      'user_id' => $customerUser->id,
      'electricity_rate_id' => $electricityRate1->id,
      'customer_code' => 'CUST001',
      'address' => 'Jakarta',
    ]);

  }
}
