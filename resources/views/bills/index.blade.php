<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('All Bills') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <a href="{{ route('bills.create') }}" type="button" class="btn btn-danger">Add New Bill</a>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Customer</th>
              <th>Year</th>
              <th>Month</th>
              <th>Usage</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($bills as $bill)
              <tr>
                <td>{{ $bill->id }}</td>
                <td>{{ $bill->customer->name }}</td>
                <td>{{ $bill->billing_year }}</td>
                <td>{{ $bill->billing_month }}</td>
                <td>{{ $bill->usage }} kWh</td>
                <td>{{ ucfirst($bill->status) }}</td>
                <td>
                  <a href="{{ route('bills.edit', $bill) }}" class="btn btn-warning">Edit</a>
                  <form action="{{ route('bills.destroy', $bill) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</x-app-layout>
