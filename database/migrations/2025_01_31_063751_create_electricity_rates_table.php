<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('electricity_rates', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
      $table->string('rate_code', 4);
      $table->integer('fixed_charge')->unsigned();
      $table->integer('rate_per_kwh')->unsigned();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('electricity_rates');
  }
};
