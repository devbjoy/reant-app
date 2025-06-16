<?php

namespace App\Livewire\Admin\Role;

use App\Models\Role;
use App\Traits\HasPermissionCheck;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Role has Permissions')]
class PermissionList extends Component
{
    use HasPermissionCheck;
    public $roleId = null;
    public function mount($id = null)
    {
        $this->authorizePermission('view role permission');
        if ($id) {
            $this->roleId = $id;
        }
    }
    public function render()
    {
        $role = Role::findOrFail($this->roleId);
        $permissions = $role->permissions;

        return view('livewire.admin.role.Permissions', compact('permissions'))
            ->layout('layouts.app');
    }
}
