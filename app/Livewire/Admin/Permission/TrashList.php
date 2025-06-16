<?php

namespace App\Livewire\Admin\Permission;

use App\Traits\HasPermissionCheck;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\Title;
use Livewire\Livewire;
use Livewire\WithPagination;

#[Title('Trashed Permission List')]
class TrashList extends Component
{
    use WithPagination, HasPermissionCheck;
    public $search = '';

    protected $listeners = [
        'RestoreData' => 'restore',
        'ForceDelete' => 'forceDelete',
    ];
    public function mount()
    {
        $this->authorizePermission('view permission trash');
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Resets pagination on search change
    }

    public function delete($id)
    {
        $this->authorizePermission('delete permission');
        $permission = Permission::withTrashed()->findOrFail($id);
        if ($permission) {
            $permission->delete(); // Soft delete the permission
            LivewireAlert::title('Permission deleted successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            $this->redirect(route('admin.permissions.trash'), true);
        } else {
            LivewireAlert::title('Permission not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }
    public function restore($id)
    {
        $this->authorizePermission('restore permission');
        $permission = Permission::withTrashed()->findOrFail($id);
        if ($permission) {
            $permission->restore(); // Restore the soft-deleted permission
            LivewireAlert::title('Permission restored successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            $this->redirect(route('admin.permissions.trash'), true);
        } else {
            LivewireAlert::title('Permission not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }
    public function forceDelete($id)
    {
        $this->authorizePermission('force delete permission');
        $permission = Permission::withTrashed()->findOrFail($id);
        if ($permission) {
            $permission->forceDelete(); // Permanently delete the permission
            LivewireAlert::title('Permission permanently deleted successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            $this->redirect(route('admin.permissions.list'), true);
        } else {
            LivewireAlert::title('Permission not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }
    public function render()
    {
        // Adjust the pagination as needed
        return view(
            'livewire.admin.permission.trash'
        )
            ->layout('layouts.app');
    }
}
