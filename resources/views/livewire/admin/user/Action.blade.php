<div class="flex space-x-2">
  @canAccess('edit user')
  <button wire:click="$dispatch('EditUser', { id: {{ $row->id }}  })"
    class="px-2 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">
    Edit
  </button>
  @endcanAccess

  @canAccess('delete user')
  <button wire:confirm wire:click="$dispatch('DeleteUser', { id: {{ $row->id }}  })"
    class="px-2 py-1 text-white bg-red-500 hover:bg-red-600 rounded">
    Delete
  </button>
  @endcanAccess
</div>
