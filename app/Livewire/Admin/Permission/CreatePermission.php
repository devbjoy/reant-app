<?php

namespace App\Livewire\Admin\Permission;

use App\Models\Permission;
use App\Traits\HasPermissionCheck;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Livewire;

#[Title('Create & Edit Permission')]
class CreatePermission extends Component
{
    use HasPermissionCheck;
    public $permissionId = null; // Used for editing an existing permission
    public $title = 'Create Permission'; // Default title for the component
    public $name;

    public $groupName;
    public $status;
    protected function rules()
    {
        $uniqueRule = $this->permissionId
            ? 'unique:permissions,name,' . $this->permissionId
            : 'unique:permissions,name';

        return [
            'name' => 'required|string|max:255|' . $uniqueRule,
            'status' => 'required|boolean',
            'groupName' => 'required|string|max:255',
        ];
    }

    public function mount($id = null)
    {
        $this->authorizePermission('add permission');
        if ($id) {
            $permission = Permission::findOrFail($id);
            // dd($permission);
            $this->permissionId = $permission->id;
            $this->name = $permission->name;
            $this->status = $permission->status ? 1 : 0;
            $this->title = 'Edit Permission';
        }

    }


    public function createPermission()
    {
        $this->authorizePermission('add permission');
        $this->validate();
        // Logic to create the permission
        // For example, using a model:
        Permission::create([
            'name' => $this->name,
            'group' => $this->groupName,
            'status' => $this->status,// Assuming status is stored as an integer (1 for active, 0 for inactive)
        ]);

        LivewireAlert::title('Permission created successfully.')
            ->success()
            ->timer(5000)
            ->position('bottom-end')
            ->toast()
            ->show();

        // Optionally reset the form fields
        $this->reset(['name', 'status']);

        $this->redirect(route('admin.permissions.list'), true);
    }

    public function updatePermission()
    {
        $this->authorizePermission('edit permission');
        $this->validate();

        $permission = Permission::findOrFail($this->permissionId);
        $permission->update([
            'name' => ucwords($this->name),
            'status' => (bool) $this->status,
        ]);
        LivewireAlert::title('Permission Updated successfully.')
            ->success()
            ->timer(5000)
            ->position('bottom-end')
            ->toast()
            ->show();
        $this->reset(['name', 'status']);
        $this->redirect(route('admin.permissions.list'), true);
    }
    public function render()
    {
        return view('livewire.admin.permission.create-permission')->layout('layouts.app');
    }
}
