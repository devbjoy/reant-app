<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  <div x-data="{ pageName: `All Permissions` }">
    @include('admin.partials.breadcrumb')
  </div>
  <!-- Breadcrumb End -->


  <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">


    <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
      <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
        Permissions
      </h3>
      <div>

        @canAccess('add permission')
        <a href="{{ route('admin.permissions.create') }}" wire:navigate
          class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 py-2 px-4 rounded text-md text-white font-medium">Add
          Permission</a>

        @endcanAccess
        @canAccess('view permission trash')
        <a href="{{ route('admin.permissions.trash') }}" wire:navigate
          class="bg-yellow-500 shadow-theme-xs hover:bg-yellow-600 py-2 px-4 rounded text-md text-white font-medium">
          View Trash</a>
        @endcanAccess
      </div>

    </div>
    <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
      <!-- Table Four -->
      @livewire('Admin.datatable.permission.permission-table')
    </div>
  </div>
</div>
