<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>{{ $title ?? 'Rental Management' }}</title>
  @livewireStyles
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ page: 'comingSoon', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
  <!-- ===== Preloader Start ===== -->
  <div>
    @include('admin.partials.preloader')
    <div class="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
      {{ $slot }}
    </div>
  </div>
  <!-- ===== Preloader End ===== -->

  <!-- ===== Page Wrapper Start ===== -->

  <!-- ===== Page Wrapper End ===== -->
  @livewireScripts
</body>

</html>
