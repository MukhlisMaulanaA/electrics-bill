<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Scripts -->
  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
  
  <style>
    .min-h-screen {
      min-height: 100vh;
    }
    .dark-bg {
      background-color: #1a202c;
    }
    .dark-header {
      background-color: #2d3748;
    }
  </style>
</head>

<body class="font-sans">
  <div class="min-h-screen bg-light dark-bg">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
      <header class="bg-white dark-header shadow-sm">
        <div class="container py-3 px-4">
          <div class="row">
            <div class="col">
              {{ $header }}
            </div>
          </div>
        </div>
      </header>
    @endisset

    <!-- Page Content -->
    <main class="py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            {{ $slot }}
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Bootstrap 5.2.3 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>