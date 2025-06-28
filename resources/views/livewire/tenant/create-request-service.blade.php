<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  <div x-data="{ pageName: `Create Service Repiar Ticket` }">
    @include('tenant.partials.breadcrumb')
  </div>
  <!-- Breadcrumb End -->


  <div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
      <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
          Create Service Repiar Ticket
        </h3>
        <a href="{{ route('tenant.service-ticket-list') }}" wire:navigate
          class=" py-2 px-4 rounded text-md text-white bg-brand-500 shadow-theme-xs hover:bg-brand-600">Back</a>
      </div>
      <form wire:submit.prevent="createServiceTicket">
        <div
          class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3">
          <!-- Elements -->
          <div class="sm:col-span-1">
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Category
            </label>
            <div class="relative z-20 bg-transparent">
              <select wire:model.live="category"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  Select Repair Type
                </option>
                <option value="Plumbing" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  Plumbing
                </option>
                <option value="Electrical" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  Electrical
                </option>
                <option value="Other" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                  Other
                </option>
              </select>
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
          {{-- elements --}}
          @if ($category === 'Other')
            <div class="sm:col-span-1">
              <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Other Category Type
              </label>
              <input type="text" placeholder="Enter your category" wire:model="other_category"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            </div>
          @endif
          <div class="col-span-1 md:col-span-2">

            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
              Description
            </label>
            <textarea wire:model="description" placeholder="Enter a description..." type="text" rows="6"
              class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
              style="height: 149px;"></textarea>

          </div>
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
                <div class="mt-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
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
            {{-- @if ($errors->has('documents'))
              <p class="text-theme-xs text-error-500 mt-1.5">
                {{ $errors->first('documents') }}
              </p>
            @endif --}}

          </div>

          <div class="col-span-1 md:col-span-2 mt-3">
            <button type="submit"
              class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
              Create Repiar Ticket
            </button>
          </div>

        </div>
      </form>
    </div>
  </div>

</div>
