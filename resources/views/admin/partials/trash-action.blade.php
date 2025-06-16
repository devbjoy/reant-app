<div class="flex space-x-2">
  <button wire:click="$dispatch('RestoreData', { id: {{ $row->id }}  })"
    class="px-2 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">
    Restor
  </button>

  <button wire:confirm="Are you sure you want to remove it?"
    wire:click="$dispatch('ForceDelete', { id: {{ $row->id }}  })"
    class="px-2 py-1 text-white bg-red-500 hover:bg-red-600 rounded">
    Delete
  </button>
</div>
