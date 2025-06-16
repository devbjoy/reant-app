<?php

namespace App\Livewire\Admin\Role;

use App\Models\Role;
use App\Traits\HasPermissionCheck;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\Title;
use Livewire\Livewire;
use Livewire\WithPagination;

#[Title('Role List')]
class RoleList extends Component
{
    use WithPagination, HasPermissionCheck;
    protected $listeners = [
        'EditRole' => 'edit',
        'DeleteRole' => 'softDelete',
        'ViewPermission' => 'viewPermission'
    ];

    public function mount()
    {
        $this->authorizePermission('view role');
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Resets pagination on search change
    }

    public function softDelete($id)
    {
        $this->authorizePermission('delete role');
        $role = Role::findOrFail($id);
        if ($role) {
            $role->delete(); // Soft delete the permissio
            LivewireAlert::title('Role deleted successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            $this->redirect(route('admin.roles.list'), true);
        } else {
            LivewireAlert::title('Role not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }

    public function edit($id)
    {
        $this->authorizePermission('edit role');
        $this->redirect(route('admin.roles.edit', $id), true);
    }

    public function viewPermission($id)
    {
        $this->authorizePermission('view role permission');
        $this->redirect(route('admin.roles.permission', $id), true);
    }

    public function render()
    {
        return view('livewire.admin.role.Index')
            ->layout('layouts.app');
    }
}
