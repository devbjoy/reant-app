<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
  <!-- Breadcrumb Start -->
  <div x-data="{ pageName: `Our Repiar Tickets` }">
    @include('tenant.partials.breadcrumb')
  </div>
  <!-- Breadcrumb End -->

  <div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
      <div class="px-5 py-4 sm:px-6 sm:py-5 flex justify-between items-center">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
          Our Repiar Ticket
        </h3>
        <a href="{{ route('tenant.request-service.create') }}" wire:navigate
          class=" py-2 px-4 rounded text-md text-white bg-brand-500 shadow-theme-xs hover:bg-brand-600">Create Repiar
          Ticket</a>
      </div>
      <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
          @foreach ($serviceTickets as $ticket)
            <div wire:key="{{ $ticket->id }}">
              <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                @php
                  $images = json_decode($ticket->images, true);
                @endphp
                <div class="mb-5 overflow-hidden rounded-lg w-full h-[200px] object-cover">
                  @if ($images)
                    <img src="{{ asset('storage/' . $images[0]) }}" alt="card"
                      class="overflow-hidden rounded-lg w-full h-full object-cover">
                  @else
                    <img src="https://placehold.co/600x200" alt="card" class="overflow-hidden rounded-lg">
                  @endif

                </div>

                <div>
                  <div class="flex justify-between items-center">

                    <h4 class="mb-1 capitalize text-theme-xl font-medium text-gray-800 dark:text-white/90">
                      {{ $ticket->category }}
                    </h4>
                    <div class="flex gap-1 items-center">
                      <span class="text-sm font-medium text-gray-500 dark:text-gray-300">Status: </span>
                      <span
                        class="inline-flex items-center justify-center gap-1 rounded-full bg-brand-50 px-2.5 py-0.5 text-sm font-medium text-brand-500 dark:bg-brand-500/15 dark:text-brand-400">
                        {{ $ticket->status }}
                      </span>
                    </div>

                  </div>

                  <p class="text-sm text-gray-500 dark:text-gray-400 py-5">
                    {{ Str::limit($ticket->description, 100) }}
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt molestias numquam, repellendus quod
                    laboriosam voluptatem ducimus laudantium. Ipsa sunt culpa, magnam fuga quia cum quas animi tenetur
                    earum accusamus? Nesciunt?
                  </p>

                  <div class="flex justify-between items-center gap-2">

                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                      <strong class="text-[16px] dark:text-gray-400"> Submitted By : </strong>
                      {{ $ticket->created_at->format('M d, Y h:i A') }}
                    </div>
                    @if ($ticket->notes->count() > 0)
                      <span wire:click="showNote({{ $ticket->id }})"
                        class="inline-flex items-center justify-center cursor-pointer gap-1 rounded-full bg-blue-light-500 px-2.5 py-0.5 text-sm font-medium text-white">
                        Note ({{ $ticket->notes?->count() ?? 0 }})
                      </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          {{ $serviceTickets->links() }}
        </div>
      </div>
    </div>

  </div>

  {{-- model --}}
  <div x-show="$wire.showNoteModel"
    class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999" style="display: none;">
    <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
    <div class="relative w-full max-w-[600px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
      <!-- close btn -->
      <button wire:click="$set('showNoteModel', false)"
        class="absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11">
        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
            fill=""></path>
        </svg>
      </button>

      {{-- @foreach ($notes as $note) --}}
      @if ($notes)
        <div>

          <h4 class="font-semibold capitalize text-gray-800 mb-7 text-title-sm dark:text-white/90">
            {{ $notes->category }}
          </h4>

          <div class="relative">
            <!-- Vertical line -->
            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-blue-500 dark:bg-gray-300 "></div>

            <!-- Step 1 -->
            @foreach ($notes->notes as $item)
              <div class="flex items-start mb-8 relative" wire:key="{{ $item->id }}">
                <!-- Serial number circle -->
                <div
                  class="relative  z-10 w-8 h-8 flex items-center justify-center rounded-full border-2 border-blue-500 text-blue-500 font-semibold bg-white dark:bg-gray-500 dark:text-gray-300 dark:border-gray-300">
                  {{ $loop->index + 1 }}
                </div>

                <!-- Step content -->
                <div class="ml-6 dark:text-gray-400">
                  {!! $item->note !!}

                </div>
              </div>
            @endforeach
          </div>

          <div class="flex items-center justify-end w-full gap-3 mt-8">
            <button wire:click="$set('showNoteModel', false)" type="button"
              class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 sm:w-auto">
              Close
            </button>
            {{-- <button type="button"
              class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto">
              Save Changes
            </button> --}}
          </div>
        </div>
      @endif
      {{-- @endforeach --}}
    </div>
  </div>

</div>
