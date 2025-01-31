<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Edit Bill') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('bills.update', $bill) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="customer_id" class="form-label">Customer</label>
              <select class="form-control" name="customer_id" id="customer_id" required>
                @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}" {{ $bill->customer_id == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="billing_year" class="form-label">Billing Year</label>
              <input type="number" class="form-control" name="billing_year" id="billing_year"
                value="{{ $bill->billing_year }}" required>
            </div>

            <div class="mb-3">
              <label for="billing_month" class="form-label">Billing Month</label>
              <input type="number" class="form-control" name="billing_month" id="billing_month"
                value="{{ $bill->billing_month }}" required>
            </div>

            <div class="mb-3">
              <label for="usage" class="form-label">Usage (kWh)</label>
              <input type="number" class="form-control" name="usage" id="usage" value="{{ $bill->usage }}"
                required>
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-control" name="status" id="status" required>
                <option value="unpaid" {{ $bill->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ $bill->status == 'paid' ? 'selected' : '' }}>Paid</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Bill</button>
            <a href="{{ route('bills.index') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>

</x-app-layout>
