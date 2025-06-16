<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  <div x-data="{ pageName: `Role Permissions` }">
    @include('admin.partials.breadcrumb')
  </div>
  <!-- Breadcrumb End -->


  <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">


    <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
      <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
        Role has Permissions
      </h3>
      <div>

        <a href="{{ route('admin.roles.list') }}" wire:navigate
          class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 py-2 px-4 rounded text-md text-white font-medium">View
          Roles</a>

      </div>

    </div>
    <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6 flex flex-wrap gap-3 justify-center">
      @foreach ($permissions as $item)
        <button
          class="bg-success-50 text-theme-md text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">
          {{ $item->name }}
        </button>
      @endforeach
    </div>
  </div>
</div>
