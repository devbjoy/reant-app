<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Reantal(M.S)</title>

  @livewireStyles
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
</head>

<body x-data="{
    page: 'ecommerce',
    loaded: true,
    darkMode: false,
    stickyMenu: false,
    sidebarToggle: false,
    scrollTop: false
}" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode') || 'false');
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode }">
  <div>
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
      class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
      <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent">
      </div>
    </div>
    <!-- Page Wrapper -->
    <div class="flex h-screen overflow-hidden">

      <!-- Sidebar -->
      @include('admin.partials.sidebar')

      <!-- Main Content -->
      <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">

        <!-- Mobile Overlay -->
        @include('admin.partials.overlay')

        <!-- Header -->
        @include('admin.partials.header')

        <!-- Content -->
        <main>
          @yield('content')
        </main>

      </div>
    </div>
  </div>


  @livewireScripts

  <!-- JS Assets -->
  <script src="{{ asset('admin/js/components/calendar-init.js') }}"></script>
  <script src="{{ asset('admin/js/components/image-resize.js') }}"></script>
  <script src="{{ asset('admin/js/components/map-01.js') }}"></script>
  <script src="{{ asset('admin/js/components/charts/chart-01.js') }}"></script>
  <script src="{{ asset('admin/js/components/charts/chart-02.js') }}"></script>
  <script src="{{ asset('admin/js/components/charts/chart-03.js') }}"></script>
  <script src="{{ asset('admin/js/index.js') }}"></script>
</body>

</html>
