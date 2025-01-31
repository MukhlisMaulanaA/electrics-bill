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
    Schema::create('bills', function (Blueprint $table) {
      $table->id();
      $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
      $table->integer('billing_year')->unsigned();
      $table->integer('billing_month')->unsigned();
      $table->integer('usage')->unsigned();
      $table->string('status')->default('unpaid'); // Tambahkan kolom status pembayaran
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('bills');
  }
};
