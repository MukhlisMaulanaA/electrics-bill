<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('My Bills') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @if ($bills->isEmpty())
            <p>No bills available.</p>
          @else
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Year</th>
                  <th>Month</th>
                  <th>Usage</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bills as $bill)
                  <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->billing_year }}</td>
                    <td>{{ $bill->billing_month }}</td>
                    <td>{{ $bill->usage }} kWh</td>
                    <td>
                      @if ($bill->status === 'paid')
                        <span class="badge bg-success">Paid</span>
                      @else
                        <span class="badge bg-warning">Unpaid</span>
                      @endif
                    </td>
                    <td>
                      @if ($bill->status === 'unpaid')
                        <form action="{{ route('bills.pay', $bill) }}" method="POST">
                          @csrf
                          <input type="text" value="paid" hidden name="status">
                          <button type="submit" class="btn btn-success">Pay</button>
                        </form>
                      @else
                        <span class="text-muted">Paid</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>

</x-app-layout>
