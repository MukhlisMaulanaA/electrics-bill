<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
  return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // Customer Routes
  Route::get('/my-bills', [BillController::class, 'customerBills'])->name('bills.customer'); // Lihat tagihan customer
  Route::post('/bills/{bill}/pay', [BillController::class, 'payBill'])->name('bills.pay'); // Bayar tagihan
});

Route::middleware(['auth', 'admin'])->group(function () {
  Route::get('/bills', [BillController::class, 'index'])->name('bills.index'); // Lihat semua tagihan
  Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create'); // Form tambah
  Route::post('/bills', [BillController::class, 'store'])->name('bills.store'); // Simpan tagihan
  Route::get('/bills/{bill}/edit', [BillController::class, 'edit'])->name('bills.edit'); // Form edit
  Route::put('/bills/{bill}', [BillController::class, 'update'])->name('bills.update'); // Simpan perubahan
  Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy'); // Hapus tagihan
});


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
