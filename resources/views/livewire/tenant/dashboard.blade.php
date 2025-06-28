<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  {{-- <div x-data="{ pageName: `Home` }">
    @include('tenant.partials.breadcrumb')
  </div> --}}
  <!-- Breadcrumb End -->


  <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

    <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        {{-- @foreach (range(0, 2) as $i) --}}
        {{-- service request card --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
          <div>
            <h4 class="mb-1 text-theme-xl font-medium text-gray-800 dark:text-white/90">
              Request a Service
            </h4>

            <p class="text-sm text-gray-500 dark:text-gray-400">
              Here you can create a service request. This request will be visible to the admin, and they will confirm
              your service shortly.
            </p>

            <a href="{{ route('tenant.request-service.create') }}" wire:navigate
              class="mt-4 inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
              Create a Service Request
            </a>
          </div>
        </div>
        {{-- payment receipts card --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
          <div>
            <h4 class="mb-1 text-theme-xl font-medium text-gray-800 dark:text-white/90">
              Payment Receipts
            </h4>

            <p class="text-sm text-gray-500 dark:text-gray-400">
              Here you can view your payment documents. You can see how much you paid and for which month or year the
              payment was made.
            </p>

            <a href="#"
              class="mt-4 inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
              View Payment Receipts
            </a>
          </div>
        </div>
        {{-- setting --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
          <div>
            <h4 class="mb-1 text-theme-xl font-medium text-gray-800 dark:text-white/90">
              Profile Info
            </h4>

            <p class="text-sm text-gray-500 dark:text-gray-400">
              Here you can view your profile info. You can update your information.
            </p>

            <a href="{{ route('tenant.profile') }}" wire:navigate
              class="mt-4 inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
              View Profile Info
            </a>
          </div>
        </div>
        {{-- @endforeach --}}
      </div>
    </div>
  </div>

  {{-- <livewire:admin.properties.add-property /> --}}

</div>
