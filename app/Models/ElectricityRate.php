<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricityRate extends Model
{
  /** @use HasFactory<\Database\Factories\ElectricityRateFactory> */
  use HasFactory;

  protected $table = 'electricity_rates';
  protected $fillable = ['user_id', 'rate_code', 'fixed_charge', 'rate_per_kwh'];

  public function user() {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function customers() {
    return $this->hasMany(Customer::class, 'electricity_rate_id');
  }
}
