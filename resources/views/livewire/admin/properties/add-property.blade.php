<div class ="fixed inset-0 flex
  items-center justify-center p-5 overflow-y-auto z-99999" x-data x-show="$wire.show"
  style="display: none;">
  <div wire:click="$set('show', false)"
    class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
  <div
    class="no-scrollbar relative flex w-full max-w-[1000px] flex-col overflow-y-auto rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11">
    <!-- close btn -->
    <button wire:click="$set('show', false)"
      class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700  dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
      <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
          fill="" />
      </svg>
    </button>

    <div class="px-2 pr-14">
      <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
        Add Property Info
      </h4>
    </div>
    <form class="flex flex-col" wire:submit="submit">
      <div class="px-2 overflow-y-auto custom-scrollbar">
        <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
          {{-- element --}}
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Property Name
            </label>
            <input type="text" placeholder="Property Name" wire:model="propertyName"
              class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            @error('propertyName')
              <p class="text-theme-xs text-error-500 mt-1.5">
                {{ $message }}
              </p>
            @enderror
          </div>
          {{-- element --}}
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Property Address
            </label>
            <input type="text" placeholder="Property Address" wire:model="propertyAddress"
              class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            @error('propertyAddress')
              <p class="text-theme-xs text-error-500 mt-1.5">
                {{ $message }}
              </p>
            @enderror
          </div>

          {{-- element --}}
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Renter Name
            </label>
            <input type="text" placeholder="Renter Name" wire:model="renterName"
              class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
            @error('renterName')
              <p class="text-theme-xs text-error-500 mt-1.5">
                {{ $message }}
              </p>
            @enderror
          </div>

          {{-- element --}}
          <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Due Date
            </label>

            <div class="relative">
              <input wire:model="dueDate" type="date" placeholder="Select date"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                onclick="this.showPicker()" />
              <span
                class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                    fill="" />
                </svg>
              </span>

            </div>
            @error('dueDate')
              <p class="text-theme-xs text-error-500 mt-1.5">
                {{ $message }}
              </p>
            @enderror
          </div>

          <div class="sm:col-span-2 grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
            {{-- element --}}
            <div>
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Monthly Rent
              </label>
              <input type="text" placeholder="Monthly Name" wire:model="rentAmount"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              @error('rentAmount')
                <p class="text-theme-xs text-error-500 mt-1.5">
                  {{ $message }}
                </p>
              @enderror
            </div>

            {{-- element --}}
            <div>
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Late Free
              </label>
              <input type="text" placeholder="Late Free" wire:model="lateFee"
                class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
              @error('lateFee')
                <p class="text-theme-xs text-error-500 mt-1.5">
                  {{ $message }}
                </p>
              @enderror
            </div>
          </div>



          <div class="sm:col-span-2 grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
            <!-- Elements -->
            <div>
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Renter Email
              </label>
              <div class="relative">
                <span
                  class="absolute top-1/2 left-0 -translate-y-1/2 border-r border-gray-200 px-3.5 py-3 text-gray-500 dark:border-gray-800 dark:text-gray-400">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M3.04175 7.06206V14.375C3.04175 14.6511 3.26561 14.875 3.54175 14.875H16.4584C16.7346 14.875 16.9584 14.6511 16.9584 14.375V7.06245L11.1443 11.1168C10.457 11.5961 9.54373 11.5961 8.85638 11.1168L3.04175 7.06206ZM16.9584 5.19262C16.9584 5.19341 16.9584 5.1942 16.9584 5.19498V5.20026C16.9572 5.22216 16.946 5.24239 16.9279 5.25501L10.2864 9.88638C10.1145 10.0062 9.8862 10.0062 9.71437 9.88638L3.07255 5.25485C3.05342 5.24151 3.04202 5.21967 3.04202 5.19636C3.042 5.15695 3.07394 5.125 3.11335 5.125H16.8871C16.9253 5.125 16.9564 5.15494 16.9584 5.19262ZM18.4584 5.21428V14.375C18.4584 15.4796 17.563 16.375 16.4584 16.375H3.54175C2.43718 16.375 1.54175 15.4796 1.54175 14.375V5.19498C1.54175 5.1852 1.54194 5.17546 1.54231 5.16577C1.55858 4.31209 2.25571 3.625 3.11335 3.625H16.8871C17.7549 3.625 18.4584 4.32843 18.4585 5.19622C18.4585 5.20225 18.4585 5.20826 18.4584 5.21428Z"
                      fill="#667085" />
                  </svg>
                </span>
                <input type="text" placeholder="info@gmail.com" wire:model="email"
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pl-[62px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />

              </div>
              @error('email')
                <p class="text-theme-xs text-error-500 mt-1.5">
                  {{ $message }}
                </p>
              @enderror
            </div>


            <!-- Elements -->
            <div x-data="{
                selectedCountry: 'US',
                countryCodes: {
                    'US': '+1',
                    'GB': '+44',
                    'CA': '+1',
                    'AU': '+61'
                },
                phoneNumber: ''
            }">
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Phone
              </label>
              <div class="relative">
                <div class="absolute">
                  <select x-model="selectedCountry" @change="phoneNumber = countryCodes[selectedCountry]"
                    class="focus:border-brand-300 focus:ring-brand-500/10 appearance-none rounded-l-lg border-0 border-r border-gray-200 bg-transparent bg-none py-3 pr-8 pl-3.5 leading-tight text-gray-700 focus:ring-3 focus:outline-hidden dark:border-gray-800 dark:text-gray-400">
                    <option value="US" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                      US
                    </option>
                    <option value="GB" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                      GB
                    </option>
                    <option value="CA" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                      CA
                    </option>
                    <option value="AU" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                      AU
                    </option>
                    <!-- Add more country codes as needed -->
                  </select>
                  <div
                    class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-700 dark:text-gray-400">
                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </div>
                </div>
                <input placeholder="+1 (555) 000-0000" wire:model="phone" x-model="phoneNumber" type="tel"
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-3 pr-4 pl-[84px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                @error('phone')
                  <p class="text-theme-xs text-error-500 mt-1.5">
                    {{ $message }}
                  </p>
                @enderror
              </div>
            </div>

          </div>

          {{-- <div class="sm:col-span-2 grid grid-cols-1 gap-x-6 gap-y-5">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
              <div class="px-5 py-4 sm:px-6 sm:py-5">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                  Upload Property Documents
                </h3>
              </div>
              <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                <form
                  class="dropzone hover:border-brand-500! dark:hover:border-brand-500! rounded-xl border border-dashed! border-gray-300! bg-gray-50 p-7 lg:p-10 dark:border-gray-700! dark:bg-gray-900"
                  id="demo-upload" action="/upload">
                  <div class="dz-message m-0!">
                    <div class="mb-[22px] flex justify-center">
                      <div
                        class="flex h-[68px] w-[68px] items-center justify-center rounded-full bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-400">
                        <svg class="fill-current" width="29" height="28" viewBox="0 0 29 28" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.5019 3.91699C14.2852 3.91699 14.0899 4.00891 13.953 4.15589L8.57363 9.53186C8.28065 9.82466 8.2805 10.2995 8.5733 10.5925C8.8661 10.8855 9.34097 10.8857 9.63396 10.5929L13.7519 6.47752V18.667C13.7519 19.0812 14.0877 19.417 14.5019 19.417C14.9161 19.417 15.2519 19.0812 15.2519 18.667V6.48234L19.3653 10.5929C19.6583 10.8857 20.1332 10.8855 20.426 10.5925C20.7188 10.2995 20.7186 9.82463 20.4256 9.53184L15.0838 4.19378C14.9463 4.02488 14.7367 3.91699 14.5019 3.91699ZM5.91626 18.667C5.91626 18.2528 5.58047 17.917 5.16626 17.917C4.75205 17.917 4.41626 18.2528 4.41626 18.667V21.8337C4.41626 23.0763 5.42362 24.0837 6.66626 24.0837H22.3339C23.5766 24.0837 24.5839 23.0763 24.5839 21.8337V18.667C24.5839 18.2528 24.2482 17.917 23.8339 17.917C23.4197 17.917 23.0839 18.2528 23.0839 18.667V21.8337C23.0839 22.2479 22.7482 22.5837 22.3339 22.5837H6.66626C6.25205 22.5837 5.91626 22.2479 5.91626 21.8337V18.667Z"
                            fill="" />
                        </svg>
                      </div>
                    </div>

                    <h4 class="text-theme-xl mb-3 text-center font-semibold text-gray-800 dark:text-white/90">
                      Drop File Here
                    </h4>
                    <span
                      class="mx-auto text-center mb-5 block w-full max-w-[290px] text-sm text-gray-700 dark:text-gray-400">
                      Drag and drop your PNG, JPG, WebP, SVG images here or
                      browse
                    </span>

                    <span class="text-theme-sm text-center block mx-auto text-brand-500 font-medium underline">
                      Browse File
                    </span>
                  </div>
                </form>
              </div>
            </div>
          </div> --}}

          <div class="sm:col-span-2 grid grid-cols-1 gap-x-6 gap-y-5" x-data="{
              isDragging: false,
              handleDrop(e) {
                  this.isDragging = false;
                  $wire.set('documents', Array.from(e.dataTransfer.files));
              }
          }">
            <div x-on:dragover.prevent="isDragging = true" x-on:dragleave.prevent="isDragging = false"
              x-on:dragover.prevent
              x-on:drop.prevent="$refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change'))"
              class="rounded-2xl border bg-white dark:bg-white/[0.03] border-dashed p-10 transition"
              :class="isDragging ? 'border-blue-500 bg-blue-50 dark:bg-gray-800' : 'border-gray-300 dark:border-gray-700'">
              <div class="text-center">
                <div class="mb-6 flex justify-center">
                  <div
                    class="flex h-[68px] w-[68px] items-center justify-center rounded-full bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-400">
                    <!-- Upload Icon -->
                    <svg class="fill-current" width="29" height="28" viewBox="0 0 29 28"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M14.5 3.9c-.2 0-.4.1-.6.3L8.6 9.5c-.3.3-.3.8 0 1.1s.8.3 1.1 0l4.1-4.1v12.2c0 .4.3.8.8.8s.8-.4.8-.8V6.5l4.1 4.1c.3.3.8.3 1.1 0s.3-.8 0-1.1L15.1 4.2c-.2-.2-.4-.3-.6-.3zM5.9 18.7c0-.4-.3-.8-.8-.8s-.8.4-.8.8v3.2c0 1.2 1 2.2 2.2 2.2h15.7c1.2 0 2.2-1 2.2-2.2v-3.2c0-.4-.3-.8-.8-.8s-.8.4-.8.8v3.2c0 .4-.3.8-.8.8H6.7c-.4 0-.8-.3-.8-.8v-3.2z" />
                    </svg>
                  </div>
                </div>

                <h4 class="text-theme-xl mb-2 font-semibold text-gray-800 dark:text-white/90">
                  Drop Files Here
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                  Drag and drop PNG, JPG, or PDF documents here, or
                </p>

                <label for="uploadInput" class="text-brand-500 font-medium underline cursor-pointer">
                  Browse Files
                </label>
                <input id="uploadInput" accept=".jpg,.jpeg,.png,.pdf" x-ref="fileInput" type="file"
                  wire:model="documents" multiple class="hidden" />
              </div>

              <div wire:loading wire:target="documents" class="mt-4 text-yellow-500">Uploading...</div>

              <!-- Preview Selected Images -->
              @if ($documents)
                <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                  @foreach ($documents as $index => $doc)
                    @if (str_starts_with($doc->getMimeType(), 'image/'))
                      {{-- @if ($doc instanceof \Livewire\TemporaryUploadedFile && str_starts_with($doc->getMimeType(), 'image/')) --}}
                      <div class="relative group">
                        <img src="{{ $doc->temporaryUrl() }}" alt="Preview"
                          class="h-32 w-full object-cover rounded-xl border border-gray-300 shadow-sm" />

                        <!-- Remove button -->
                        <button type="button" wire:click="removeDocument({{ $index }})"
                          class="absolute top-1 right-1 bg-black/50 text-white rounded-full p-1 w-6 h-6 flex justify-center items-center opacity-0 group-hover:opacity-100 group-hover:text-red-400 transition"
                          title="Remove">
                          &times;
                        </button>
                      </div>
                    @else
                      <div class="p-4 bg-gray-100 rounded-lg text-sm text-gray-600">
                        {{ $doc->getClientOriginalName() }}
                        <button type="button" wire:click="removeDocument({{ $index }})"
                          class="ml-2 text-red-500 hover:underline text-xs">Remove</button>
                      </div>
                    @endif
                  @endforeach
                </div>
              @endif



            </div>
            @if ($errors->has('documents'))
              <p class="text-theme-xs text-error-500 mt-1.5">
                {{ $errors->first('documents') }}
              </p>
            @endif

          </div>

        </div>
      </div>
      <div class="flex items-center gap-3 mt-6 lg:justify-end">
        <button wire:click="$set('show', false)" type="button"
          class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
          Close
        </button>
        <button type="submit"
          class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
          Save
        </button>
      </div>
    </form>
  </div>
</div>
