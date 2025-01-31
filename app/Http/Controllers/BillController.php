<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
  /**
   * Menampilkan semua tagihan (hanya untuk admin).
   */
  public function index()
  {
    $bills = Bill::with('customer')->get();
    return view('bills.index', compact('bills'));
  }

  /**
   * Menampilkan tagihan customer yang sedang login.
   */
  public function customerBills()
  {
    $customer = Auth::user()->customer; // Ambil data customer yang terkait dengan user yang sedang login

    if (!$customer) {
      return redirect()->route('dashboard')->with('error', 'You are not registered as a customer.');
    }

    $bills = Bill::where('customer_id', $customer->id)->get(); // Ambil hanya tagihan milik customer ini

    return view('bills.customer', compact('bills'));
  }

  /**
   * Menampilkan form tambah tagihan (admin).
   */
  public function create()
  {
    $customers = Customer::all();
    // dd($customers->customerName);
    return view('bills.create', compact('customers'));
  }

  /**
   * Menyimpan tagihan baru (admin).
   */
  public function store(Request $request)
  {
    // dd($request->customer_id);
    $validated = $request->validate([
      'customer_id' => 'required|exists:customers,id',
      'billing_year' => 'required|integer',
      'billing_month' => 'required|integer|between:1,12',
      'usage' => 'required|integer|min:1',
    ]);

    Bill::create([
      'customer_id' => $validated['customer_id'], // Pastikan ini ID dari tabel customers, bukan users
      'billing_year' => $validated['billing_year'],
      'billing_month' => $validated['billing_month'],
      'usage' => $validated['usage'],
      'status' => 'unpaid',
    ]);

    return redirect()->route('bills.index')->with('success', 'Bill created successfully!');
  }

  /**
   * Menampilkan form edit tagihan (admin).
   */
  public function edit(Bill $bill)
  {
    $customers = Customer::all();
    return view('bills.edit', compact('bill', 'customers'));
  }

  public function update(Request $request, Bill $bill)
  {
    $validated = $request->validate([
      'customer_id' => 'required|exists:customers,id',
      'billing_year' => 'required|integer',
      'billing_month' => 'required|integer|between:1,12',
      'usage' => 'required|integer|min:1',
      'status' => 'required|in:unpaid,paid',
    ]);
    // dd($validated);

    // $bill->save($validated);
    $bill->update($validated);

    return redirect()->route('bills.index')->with('success', 'Bill updated successfully!');
  }


  /**
   * Menghapus tagihan (admin).
   */
  public function destroy(Bill $bill)
  {
    $bill->delete();
    return redirect()->route('bills.index')->with('success', 'Bill deleted successfully!');
  }

  /**
   * Customer membayar tagihan.
   */
  public function payBill(Bill $bill)
  {
    if (Auth::user()->customer->id !== $bill->customer_id) {
      return redirect()->route('bills.customer')->with('error', 'Unauthorized action!');
    }

    if ($bill->status === 'paid') {
      return redirect()->route('bills.customer')->with('error', 'Bill already paid!');
    }

    $bill->update(['status' => 'paid']);

    return redirect()->route('bills.customer')->with('success', 'Bill paid successfully!');
  }

}

