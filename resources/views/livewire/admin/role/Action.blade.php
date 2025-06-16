<div class="flex space-x-2">
  @canAccess('view role permission')
  <button wire:click="$dispatch('ViewPermission', { id: {{ $row->id }}  })"
    class="px-2 py-1 text-white bg-orange-500 hover:bg-orange-600 rounded">
    View Permission
  </button>
  @endcanAccess

  @canAccess('edit role')
  <button wire:click="$dispatch('EditRole', { id: {{ $row->id }}  })"
    class="px-2 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded">
    Edit
  </button>
  @endcanAccess

  @canAccess('delete role')
  <button wire:confirm wire:click="$dispatch('DeleteRole', { id: {{ $row->id }}  })"
    class="px-2 py-1 text-white bg-red-500 hover:bg-red-600 rounded">
    Delete
  </button>
  @endcanAccess
</div>
