<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->group(function () {
  Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

  // Billing Management
  // Route::get('/billing', [AdminController::class, 'manageBilling'])->name('admin.billing');
  Route::get('/bills', [BillController::class, 'index'])->name('bills.index'); // Lihat semua tagihan
  Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create'); // Form tambah
  Route::post('/bills', [BillController::class, 'store'])->name('bills.store'); // Simpan tagihan
  Route::get('/bills/{bill}/edit', [BillController::class, 'edit'])->name('bills.edit'); // Form edit
  Route::put('/bills/{bill}', [BillController::class, 'update'])->name('bills.update'); // Simpan perubahan
  Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy'); // Hapus tagihan

  // User Management
  Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
});
