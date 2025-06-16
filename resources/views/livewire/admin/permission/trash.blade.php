<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  <div x-data="{ pageName: `All Trash Permissions` }">
    @include('admin.partials.breadcrumb')
  </div>
  <!-- Breadcrumb End -->


  <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">


    <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
      <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
        Trashed Permissions
      </h3>
      <div>
        @canAccess('view permission')
        <a href="{{ route('admin.permissions.list') }}" wire:navigate
          class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 py-2 px-4 rounded text-md text-white font-medium">
          All Permission</a>
        @endcanAccess
      </div>

    </div>
    <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
      @livewire('Admin.datatable.permission.trashed-table')
    </div>
  </div>
</div>
