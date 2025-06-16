{{-- <div>
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold">Properties</h2>
    <button wire:click="toggleForm" class="bg-blue-500 text-white px-4 py-2 rounded">
      {{ $showForm ? 'Close' : '+ Add New Property' }}
    </button>
  </div>

  @if ($showForm)
    <form wire:submit.prevent="addProperty" class="space-y-4 bg-gray-100 p-4 rounded shadow">
      <div>
        <label>Property Name</label>
        <input type="text" wire:model="propertyName" class="w-full border p-2 rounded" />
        @error('propertyName')
          <span class="text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <div>
        <label>Address</label>
        <textarea wire:model="propertyAddress" class="w-full border p-2 rounded"></textarea>
        @error('propertyAddress')
          <span class="text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <div>
        <label>Renter Name</label>
        <input type="text" wire:model="renterName" class="w-full border p-2 rounded" />
        @error('renterName')
          <span class="text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label>Monthly Rent</label>
          <input type="number" wire:model="rentAmount" class="w-full border p-2 rounded" />
          @error('rentAmount')
            <span class="text-red-500">{{ $message }}</span>
          @enderror
        </div>
        <div>
          <label>Late Fee</label>
          <input type="number" wire:model="lateFee" class="w-full border p-2 rounded" />
          @error('lateFee')
            <span class="text-red-500">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div>
        <label>Rent Due Date</label>
        <input type="date" wire:model="dueDate" class="w-full border p-2 rounded" />
        @error('dueDate')
          <span class="text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label>Renter Email</label>
          <input type="email" wire:model="email" class="w-full border p-2 rounded" />
          @error('email')
            <span class="text-red-500">{{ $message }}</span>
          @enderror
        </div>
        <div>
          <label>Phone</label>
          <input type="text" wire:model="phone" class="w-full border p-2 rounded" />
          @error('phone')
            <span class="text-red-500">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div>
        <label>PIN Number (if needed)</label>
        <input type="text" wire:model="pinNumber" class="w-full border p-2 rounded" />
      </div>

      <div>
        <label>Documents</label>
        <input type="file" wire:model="documents" multiple class="w-full border p-2 rounded" />
        @error('documents.*')
          <span class="text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
  @endif

  <div class="grid grid-cols-3 gap-4 mt-8">
    {{-- @foreach ($properties as $property)
          <div class="border p-4 rounded shadow flex flex-col items-center" style="border-color: {{ $this->getStatusColor($property->due_date, $property->last_paid_at) }}">
              <div class="w-16 h-16 rounded-full bg-{{ $this->getStatusColor($property->due_date, $property->last_paid_at) }}-500 flex items-center justify-center text-white text-xl font-bold">
                  {{ strtoupper(substr($property->name, 0, 1)) }}
              </div>
              <h3 class="mt-2 font-semibold">{{ $property->name }}</h3>
              <p class="text-sm">{{ $property->tenant->name ?? 'No Tenant' }}</p>
              <button wire:click="markAsPaid({{ $property->id }})" class="mt-2 bg-indigo-500 text-white px-3 py-1 rounded">
                  Mark as Paid & Send Receipt
              </button>
          </div>
      @endforeach --}}
{{-- </div>
</div> --}}

<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  <div x-data="{ pageName: `Dashboard` }">
    @include('admin.partials.breadcrumb')
  </div>
  <!-- Breadcrumb End -->


  <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    {{-- here are the flash message show --}}
    @if (session('message'))
      <div
        class="rounded-xl rounded-br-none rounded-bl-none border border-success-500 bg-success-50 p-4 dark:border-success-500/30 dark:bg-success-500/15">
        <div class="flex items-start gap-3">
          <div class="-mt-0.5 text-success-500">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z"
                fill=""></path>
            </svg>
          </div>

          <div>
            <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">
              Success Message
            </h4>

            <p class="text-sm text-gray-500 dark:text-gray-400">
              {{ session('message') }}
            </p>

          </div>
        </div>
      </div>
    @endif

    @if (session('error'))
      <div
        class="rounded-xl border rounded-br-none rounded-bl-none  border-error-500 bg-error-50 p-4 dark:border-error-500/30 dark:bg-error-500/15">
        <div class="flex items-start gap-3">
          <div class="-mt-0.5 text-error-500">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M20.3499 12.0004C20.3499 16.612 16.6115 20.3504 11.9999 20.3504C7.38832 20.3504 3.6499 16.612 3.6499 12.0004C3.6499 7.38881 7.38833 3.65039 11.9999 3.65039C16.6115 3.65039 20.3499 7.38881 20.3499 12.0004ZM11.9999 22.1504C17.6056 22.1504 22.1499 17.6061 22.1499 12.0004C22.1499 6.3947 17.6056 1.85039 11.9999 1.85039C6.39421 1.85039 1.8499 6.3947 1.8499 12.0004C1.8499 17.6061 6.39421 22.1504 11.9999 22.1504ZM13.0008 16.4753C13.0008 15.923 12.5531 15.4753 12.0008 15.4753L11.9998 15.4753C11.4475 15.4753 10.9998 15.923 10.9998 16.4753C10.9998 17.0276 11.4475 17.4753 11.9998 17.4753L12.0008 17.4753C12.5531 17.4753 13.0008 17.0276 13.0008 16.4753ZM11.9998 6.62898C12.414 6.62898 12.7498 6.96476 12.7498 7.37898L12.7498 13.0555C12.7498 13.4697 12.414 13.8055 11.9998 13.8055C11.5856 13.8055 11.2498 13.4697 11.2498 13.0555L11.2498 7.37898C11.2498 6.96476 11.5856 6.62898 11.9998 6.62898Z"
                fill="#F04438"></path>
            </svg>
          </div>
          <div>
            <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">
              Error Message
            </h4>

            <p class="text-sm text-gray-500 dark:text-gray-400">
              {{ session('error') }}
            </p>
          </div>
        </div>
      </div>
    @endif
    {{-- here are the flash message show --}}

    <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
      <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
        Properties
      </h3>
      <div>
        <button wire:click="$dispatch('openAddressModal')"
          class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 py-2 px-4 rounded text-md text-white font-medium">Add
          New Property</button>
        <a href="#" wire:navigate
          class="bg-yellow-500 shadow-theme-xs hover:bg-yellow-600 py-2 px-4 rounded text-md text-white font-medium">
          View Trash</a>
      </div>

    </div>
    <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">

    </div>
  </div>

  <livewire:admin.properties.add-property />

</div>
