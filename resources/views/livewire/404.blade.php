<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  <div x-data="{ pageName: `404 Page` }">
    @include('admin.partials.breadcrumb')
  </div>
  <!-- Breadcrumb End -->


  <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="mx-auto w-full max-w-[242px] text-center sm:max-w-[472px]">
      <h1 class="mb-8 text-title-md font-bold text-gray-800 dark:text-white/90 xl:text-title-2xl">
        ERROR
      </h1>

      <img src="src/images/error/404.svg" alt="404" class="dark:hidden">
      <img src="src/images/error/404-dark.svg" alt="404" class="hidden dark:block">

      <p class="mb-6 mt-10 text-base text-gray-700 dark:text-gray-400 sm:text-lg">
        UnAuthorize Action
      </p>

      <a href="{{ route('admin.dashboard') }}" wire:navigate
        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
        Back to Home Page
      </a>
    </div>
  </div>
