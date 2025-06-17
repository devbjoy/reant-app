<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  <div x-data="{ pageName: 'Company Setting' }">
    @include('admin.partials.breadcrumb')
  </div>
  <!-- Breadcrumb End -->

  <div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
      <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
          Update Company Site Info
        </h3>
      </div>
      <form wire:submit.prevent="updateCompanySettingInfo">
        <div
          class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3">
          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Site Name
            </label>
            <input type="text" placeholder="Site Name" wire:model="site_name"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            @error('site_name')
              <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
          </div>
          {{-- element --}}
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Site Email
            </label>
            <div class="relative">
              <span
                class="absolute top-1/2 left-0 -translate-y-1/2 border-r border-gray-200 px-3.5 py-3 text-gray-500 dark:border-gray-800 dark:text-gray-400">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M3.04175 7.06206V14.375C3.04175 14.6511 3.26561 14.875 3.54175 14.875H16.4584C16.7346 14.875 16.9584 14.6511 16.9584 14.375V7.06245L11.1443 11.1168C10.457 11.5961 9.54373 11.5961 8.85638 11.1168L3.04175 7.06206ZM16.9584 5.19262C16.9584 5.19341 16.9584 5.1942 16.9584 5.19498V5.20026C16.9572 5.22216 16.946 5.24239 16.9279 5.25501L10.2864 9.88638C10.1145 10.0062 9.8862 10.0062 9.71437 9.88638L3.07255 5.25485C3.05342 5.24151 3.04202 5.21967 3.04202 5.19636C3.042 5.15695 3.07394 5.125 3.11335 5.125H16.8871C16.9253 5.125 16.9564 5.15494 16.9584 5.19262ZM18.4584 5.21428V14.375C18.4584 15.4796 17.563 16.375 16.4584 16.375H3.54175C2.43718 16.375 1.54175 15.4796 1.54175 14.375V5.19498C1.54175 5.1852 1.54194 5.17546 1.54231 5.16577C1.55858 4.31209 2.25571 3.625 3.11335 3.625H16.8871C17.7549 3.625 18.4584 4.32843 18.4585 5.19622C18.4585 5.20225 18.4585 5.20826 18.4584 5.21428Z"
                    fill="#667085"></path>
                </svg>
              </span>
              <input type="text" wire:model="site_email" placeholder="info@gmail.com"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-[62px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            </div>
            @error('site_email')
              <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
          </div>
          {{-- element --}}
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Site Logo
            </label>
            <input type="file" wire:model="site_logo"
              class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400  dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
            @if ($site_logo || $oldLogo)
              <div class="w-32 h-20 object-contain mt-2 relative group">
                <img src="{{ $site_logo ? $site_logo->temporaryUrl() : asset('storage/' . $oldLogo) }}" alt="Preview"
                  class="h-20 w-full object-cover rounded-xl border border-gray-300 shadow-sm" />
                <button type="button" wire:click="removeTempImage"
                  class="absolute top-1 right-1 bg-black/50 text-white rounded-full p-1 w-6 h-6 flex justify-center items-center opacity-0 group-hover:opacity-100 group-hover:text-red-400 transition"
                  title="Remove">
                  &times;
                </button>
              </div>
            @endif
          </div>

          {{-- element --}}
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Site Icon
            </label>
            <input type="file" wire:model="site_icon"
              class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400  dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
            @if ($site_icon || $oldLogoIcon)
              <div class="w-32 h-20 object-contain mt-2 relative group">
                <img src="{{ $site_icon ? $site_icon->temporaryUrl() : asset('storage/' . $oldLogoIcon) }}"
                  alt="Preview" class="h-20 w-full object-cover rounded-xl border border-gray-300 shadow-sm" />
                <button type="button" wire:click="removeTempSiteIcon"
                  class="absolute top-1 right-1 bg-black/50 text-white rounded-full p-1 w-6 h-6 flex justify-center items-center opacity-0 group-hover:opacity-100 group-hover:text-red-400 transition"
                  title="Remove">
                  &times;
                </button>
              </div>
            @endif
          </div>

          <div class="col-span-1 md:col-span-2">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
              SMTP Info
            </h3>
          </div>

          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Mail Mailer
            </label>
            <input type="text" placeholder="Mail Mailer" wire:model="mail_mailer"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            @error('mail_mailer')
              <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Mail Host
            </label>
            <input type="text" placeholder="Mail Host" wire:model="mail_host"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            @error('mail_host')
              <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Mail Port
            </label>
            <input type="text" placeholder="Mail Port" wire:model="mail_port"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            @error('mail_port')
              <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Mail Username
            </label>
            <input type="text" placeholder="Mail Username" wire:model="mail_username"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            @error('mail_username')
              <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
          </div>
          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Mail Password
            </label>
            <input type="text" placeholder="Mail Port" wire:model="mail_password"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            @error('mail_password')
              <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Mail Encryption
            </label>
            <div class="relative z-20 bg-transparent">
              <select wire:model="mail_encryption"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                <option value="ssl" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  SSL
                </option>
                <option value="tls" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  TLS
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

          <div class="col-span-1 md:col-span-2 mt-3">
            <button type="submit"
              class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
              Update Settings
            </button>
          </div>

        </div>
      </form>
    </div>
  </div>

</div>
