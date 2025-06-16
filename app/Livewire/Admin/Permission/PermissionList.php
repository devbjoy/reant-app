<?php

namespace App\Livewire\Admin\Permission;

use App\Traits\HasPermissionCheck;
use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Title('Permission List')]
class PermissionList extends Component
{
    use WithPagination, HasPermissionCheck;
    protected $listeners = [
        'EditPermission' => 'edit',
        'DeletePermission' => 'delete',
    ];

    protected $queryString = ['search']; // Optional: keep search in the URL

    public function updatingSearch()
    {
        $this->resetPage(); // Resets pagination on search change
    }
    public function mount()
    {
        $this->authorizePermission('view permission');
    }
    public function delete($id)
    {
        $this->authorizePermission('delete permission');
        $permission = Permission::findOrFail($id);
        if ($permission) {
            $permission->delete(); // Soft delete the permissio
            LivewireAlert::title('Permission deleted successfully.')
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



    public function edit($id)
    {
        $this->authorizePermission('edit permission');
        // Redirect to edit page or open modal
        $this->redirect(route('admin.permissions.edit', $id), true);
    }

    public function render()
    {
        return view('livewire.admin.permission.permission-list')
            ->layout('layouts.app');
    }
}
