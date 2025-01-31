<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Create New Bill') }}
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

          <form action="{{ route('bills.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="customer_id" class="form-label">Customer</label>
              <select class="form-control" name="customer_id" id="customer_id" required>
                <option value="">Select Customer</option>
                @foreach ($customers as $customer)
                  <option class="text-dark" value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="billing_year" class="form-label">Billing Year</label>
              <input type="number" class="form-control" name="billing_year" id="billing_year"
                value="{{ old('billing_year', date('Y')) }}" required>
            </div>

            <div class="mb-3">
              <label for="billing_month" class="form-label">Billing Month</label>
              <select class="form-control" name="billing_month" id="billing_month" required>
                @foreach (range(1, 12) as $month)
                  <option value="{{ $month }}" {{ old('billing_month') == $month ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="usage" class="form-label">Usage (kWh)</label>
              <input type="number" class="form-control" name="usage" id="usage" value="{{ old('usage') }}"
                required>
            </div>

            <button type="submit" class="btn btn-primary">Create Bill</button>
            <a href="{{ route('bills.index') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>

</x-app-layout>
