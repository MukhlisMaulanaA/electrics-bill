<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
  use HasFactory;

  protected $table = 'bills';
  protected $fillable = ['customer_id', 'billing_year', 'billing_month', 'usage', 'status'];

  public function customer()
  {
    return $this->belongsTo(Customer::class, 'customer_id');
  }
}
