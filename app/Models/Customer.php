<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  /** @use HasFactory<\Database\Factories\CustomerFactory> */
  use HasFactory;

  // protected $table = 'customers';
  protected $fillable = ['user_id','electricity_rate_id', 'customer_code', 'address'];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function getNameAttribute()
  {
    return $this->user->name;
  }

  public function electricityRate()
  {
    return $this->belongsTo(ElectricityRate::class, 'electricity_rate_id');
  }

  public function bills()
  {
    return $this->hasMany(Bill::class, 'customer_id');
  }

}
