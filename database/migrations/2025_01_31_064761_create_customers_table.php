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
    Schema::create('customers', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
      $table->foreignId('electricity_rate_id')->constrained('electricity_rates')->onDelete('cascade');
      $table->string('customer_code')->unique();
      $table->text('address');
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('customers');
  }
};
