<?php

namespace App\Livewire\Admin\Role;

use App\Models\Role;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\Title;
use Livewire\Livewire;
use Livewire\WithPagination;
use App\Traits\HasPermissionCheck;

#[Title('Trashed Role List')]
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
        $this->authorizePermission('view role trash');
    }

    public function restore($id)
    {
        $this->authorizePermission('restore role');
        $role = Role::withTrashed()->findOrFail($id);
        if ($role) {
            $role->restore(); // Restore the soft-deleted role
            LivewireAlert::title('Role restored successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            $this->redirect(route('admin.roles.trash'), true);
        } else {
            LivewireAlert::title('Role not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }
    public function forceDelete($id)
    {
        $this->authorizePermission('force delete role');
        $role = Role::withTrashed()->findOrFail($id);
        if ($role) {
            $role->permissions()->detach(); // Removes all related permission links from pivot table
            $role->forceDelete(); // Permanently delete the role
            LivewireAlert::title('Role permanently deleted successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            $this->redirect(route('admin.roles.trash'), true);

        } else {
            LivewireAlert::title('Role not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }
    public function render()
    {

        return view('livewire.admin.role.Trash')
            ->layout('layouts.app');
    }
}
