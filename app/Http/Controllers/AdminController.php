<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ElectricityRate;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function index()
  {
    return view('dashboard');
  }
  // Add other management methods
}