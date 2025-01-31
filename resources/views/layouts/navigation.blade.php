<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <x-application-logo style="height: 2.25rem;" />
    </a>

    <!-- Hamburger Menu -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navigation Content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <!-- Left Navigation Links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link @if (request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
            {{ __('Dashboard') }}
          </a>
        </li>
      </ul>

      <!-- Right Navigation -->
      <ul class="navbar-nav ms-auto">
        <!-- User Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="{{ route('profile.edit') }}">
                {{ __('Profile') }}
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); this.closest('form').submit();">
                  {{ __('Log Out') }}
                </a>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Mobile Menu Content -->
<div class="collapse navbar-collapse" id="navbarContent">
  <div class="container">
    <!-- Mobile Navigation Links -->
    <div class="py-2">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link @if (request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
            {{ __('Dashboard') }}
          </a>
        </li>
      </ul>
    </div>

    <!-- Mobile User Menu -->
    <div class="py-3 border-top">
      <div class="mb-3 px-2">
        <div class="fw-bold">{{ Auth::user()->name }}</div>
        <div class="text-muted small">{{ Auth::user()->email }}</div>
      </div>

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profile.edit') }}">
            {{ __('Profile') }}
          </a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault(); this.closest('form').submit();">
              {{ __('Log Out') }}
            </a>
          </form>
        </li>
      </ul>
    </div>
  </div>
</div>
