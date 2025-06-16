<?php

namespace App\Livewire\Admin\Role;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\HasPermissionCheck;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Create Role')]
class RoleCreate extends Component
{
    use WithPagination, HasPermissionCheck;
    // public $roleId = null; // Used for editing an existing permission
    public $name;
    public $status;

    public $selectedPermissions = []; // Array to hold selected permissions

    protected $rules = [
        'name' => 'required|string|unique:roles,name|max:255', // Ensure the role name is unique
        'status' => 'required|boolean',
        'selectedPermissions' => 'nullable|array', // Assuming you want to handle permissions as an array
        'selectedPermissions.*' => 'exists:permissions,id', // Validate each permission ID exists in the permissions table
    ];

    public function mount()
    {
        $this->authorizePermission('add role');
    }


    public function createRole()
    {
        $this->validate();
        // For example, using a model:
        $role = Role::create([
            'name' => $this->name,
            'status' => $this->status,// Assuming status is stored as an integer (1 for active, 0 for inactive)
        ]);

        // Attach selected permissions to the role
        if (!empty($this->selectedPermissions)) {
            $role->permissions()->attach($this->selectedPermissions);
        }

        LivewireAlert::title('Role created successfully.')
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
        return view('livewire.admin.role.Create', compact('permissions'))->layout('layouts.app');
    }
}
