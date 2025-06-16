<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  <div x-data="{ pageName: 'Edit User' }">
    @include('admin.partials.breadcrumb')
  </div>
  <!-- Breadcrumb End -->

  <div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
      <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
          Update User
        </h3>
        <a href="{{ route('admin.users.list') }}" wire:navigate
          class=" py-2 px-4 rounded text-md text-white bg-brand-500 shadow-theme-xs hover:bg-brand-600">Back</a>
      </div>
      <form wire:submit.prevent="updateUser">
        <div
          class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3">
          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Name
            </label>
            <input type="text" placeholder="Name" wire:model="name"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            @error('name')
              <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Email
            </label>
            <input type="email" placeholder="example@gmail.com" wire:model="email"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            @error('email')
              <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Status
            </label>
            <div class="relative z-20 bg-transparent">
              <select wire:model="status"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  Select Option
                </option>
                <option value="1" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  Active
                </option>
                <option value="0" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  Block
                </option>
              </select>
              @error('status')
                <p class="text-red-400 text-sm">{{ $message }}</p>
              @enderror
              <span
                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </span>
            </div>
          </div>

          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Roles
            </label>
            <div class="relative z-20 bg-transparent">
              <select wire:model="seletedRole" multiple
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  Select Role
                </option>
                @foreach ($roles as $role)
                  <option value="{{ $role->id }}" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                    {{ $role->name }}
                  </option>
                @endforeach
              </select>
              @error('seletedRole')
                <p class="text-red-400 text-sm">{{ $message }}</p>
              @enderror
              <span
                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </span>
            </div>
          </div>
          <div class="col-span-1 md:col-span-2 mt-3">
            <button type="submit"
              class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
              Update
            </button>
          </div>

        </div>
      </form>
    </div>
  </div>

</div>
