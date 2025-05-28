<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Sign In| TailAdmin - Tailwind CSS Admin Dashboard Template</title>
  @livewireStyles
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  {{-- <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}"> --}}
</head>

<body x-data="{ page: 'comingSoon', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
  <!-- ===== Preloader Start ===== -->
  <div>
    @include('admin.partials.preloader')
    <div class="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
      @yield('content')
    </div>
  </div>
  <!-- ===== Preloader End ===== -->

  <!-- ===== Page Wrapper Start ===== -->

  <!-- ===== Page Wrapper End ===== -->
  @livewireScripts
  <!-- JS Assets -->
  {{-- <script src="{{ asset('admin/js/components/calendar-init.js') }}"></script>
  <script src="{{ asset('admin/js/components/image-resize.js') }}"></script>
  <script src="{{ asset('admin/js/components/map-01.js') }}"></script>
  <script src="{{ asset('admin/js/components/charts/chart-01.js') }}"></script>
  <script src="{{ asset('admin/js/components/charts/chart-02.js') }}"></script>
  <script src="{{ asset('admin/js/components/charts/chart-03.js') }}"></script> --}}
  <script src="{{ asset('admin/js/index.js') }}"></script>
</body>

</html>
