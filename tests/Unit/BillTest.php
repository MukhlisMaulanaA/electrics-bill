<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\ElectricityRate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BillTest extends TestCase
{
  use RefreshDatabase;

  protected $admin;
  protected $customerUser;
  protected $customer;
  protected $rate;
  protected $bill;

  protected function setUp(): void
  {
    parent::setUp();

    // Buat user admin
    $this->admin = User::factory()->create(['is_admin' => true]);

    // Buat user customer
    $this->customerUser = User::factory()->create(['is_admin' => false]);


    // Buat tarif listrik menggunakan Factory
    $this->rate = ElectricityRate::factory()->create([
      'user_id' => $this->admin->id, // Pastikan tarif listrik dimiliki oleh admin
    ]);

    // Buat customer yang terhubung dengan user customer
    $this->customer = Customer::factory()->create([
      'user_id' => $this->customerUser->id, // Customer milik user customer
      'electricity_rate_id' => $this->rate->id, // Customer menggunakan tarif listrik yang dibuat
    ]);

    // Buat tagihan
    $this->bill = Bill::factory()->create([
      'customer_id' => $this->customer->id,
      'billing_year' => 2025,
      'billing_month' => 1,
      'usage' => 100,
      'status' => 'unpaid',
    ]);
  }

  public function test_admin_can_create_a_bill()
  {
    $response = $this->actingAs($this->admin)
      ->post(route('bills.store'), [
        'customer_id' => $this->customer->id,
        'billing_year' => 2025,
        'billing_month' => 2,
        'usage' => 150,
        'status' => 'unpaid',
      ]);

    $response->assertRedirect(route('bills.index'));

    $this->assertDatabaseHas('bills', [
      'billing_month' => 2,
      'status' => 'unpaid',
    ]);
  }


  public function test_admin_can_update_a_bill()
  {
    $response = $this->actingAs($this->admin)
      ->put(route('bills.update', $this->bill), [
        'customer_id' => $this->customer->id,
        'billing_year' => 2025,
        'billing_month' => 3,
        'usage' => 200,
        'status' => 'paid',
      ]);

    $response->assertRedirect(route('bills.index'));

    $this->bill->refresh();

    $this->assertEquals(3, $this->bill->billing_month);
    $this->assertEquals('paid', $this->bill->status);
  }

  public function test_admin_can_delete_a_bill()
  {
    $response = $this->actingAs($this->admin)
      ->delete(route('bills.destroy', $this->bill));

    $response->assertRedirect(route('bills.index'));

    $this->assertDatabaseMissing('bills', [
      'id' => $this->bill->id,
    ]);
  }

  public function test_customer_can_view_their_own_bills()
  {
    $response = $this->actingAs($this->customerUser)
      ->get(route('bills.customer'));

    $response->assertOk()
      ->assertSee($this->bill->billing_year)
      ->assertSee($this->bill->billing_month)
      ->assertSee($this->bill->usage);
  }

  public function test_customer_can_pay_their_bill()
  {
    $response = $this->actingAs($this->customerUser)
      ->post(route('bills.pay', $this->bill));

    $response->assertRedirect(route('bills.customer'));

    $this->bill->refresh();

    $this->assertEquals('paid', $this->bill->status);
  }
}
