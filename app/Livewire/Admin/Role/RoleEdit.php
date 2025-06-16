<?php

namespace App\Livewire\Admin\Role;

use App\Models\Permission;
use App\Models\Role;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\HasPermissionCheck;

#[Title('Edit Role')]
class RoleEdit extends Component
{
    use WithPagination, HasPermissionCheck;
    public $name;
    public $roleId; // Used for editing an existing rol
    public $status;

    public $selectedPermissions = []; // Array to hold selected permissions


    public function mount($id = null)
    {
        $this->authorizePermission('edit role');
        if ($id) {
            $role = Role::findOrFail($id);
            $this->roleId = $id; // Set the role ID for editing
            $this->name = $role->name;
            $this->status = $role->status ? 1 : 0;

            $this->selectedPermissions = $role->permissions->pluck('id')->toArray(); // Get the IDs of the permissions associated with the role
        }

    }
    protected $rules = [
        // 'name' => 'required|string|unique:roles,name,' . $this->roleId,
        'status' => 'required|boolean',
        'selectedPermissions' => 'nullable|array',
        'selectedPermissions.*' => 'exists:permissions,id',
    ];
    public function updateRole()
    {
        $this->validate();
        // For example, using a model:
        $role = Role::findOrFail($this->roleId);
        $role->update([
            'name' => $this->name,
            'status' => $this->status, // Assuming status is stored as an integer (1 for active, 0 for inactive)
        ]);

        // Attach selected permissions to the role
        if (!empty($this->selectedPermissions)) {
            $role->permissions()->sync($this->selectedPermissions);
        }

        LivewireAlert::title('Role Updated successfully.')
            ->success()
            ->timer(5000)
            ->position('bottom-end')
            ->toast()
            ->show();

        $this->redirect(route('admin.roles.list'), true);
        // Optionally reset the form fields
        $this->reset(['name', 'status']);
    }

    public function render()
    {
        $permissions = Permission::active()->latest()->get(); // Fetch all permissions for the dropdown
        return view('livewire.admin.role.Edit', [
            'permissions' => $permissions, // Pass permissions
            'selectedPermissions' => $this->selectedPermissions, // Pass selected permissions
        ])->layout('layouts.app');
    }
}
