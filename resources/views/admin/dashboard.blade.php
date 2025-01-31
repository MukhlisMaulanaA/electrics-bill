@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">Admin Menu</div>
          <div class="card-body">
            <ul class="list-group">
              {{-- <a href="{{ route('admin.users') }}" class="list-group-item">Manage Users</a>
              <a href="{{ route('admin.rates') }}" class="list-group-item">Electricity Rates</a>
              <a href="{{ route('admin.customers') }}" class="list-group-item">Customer Management</a>
              <a href="{{ route('admin.billing') }}" class="list-group-item">Billing Management</a> --}}
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="list-group-item">Logout</a>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        @yield('admin-content')
      </div>
    </div>
  </div>
@endsection
