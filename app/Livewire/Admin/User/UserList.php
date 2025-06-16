<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use App\Traits\HasPermissionCheck;
use Jantinnerezo\LivewireAlert\Concerns\SweetAlert2;
use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;


#[Title('User List')]
class UserList extends Component
{
    use WithPagination, HasPermissionCheck;
    protected $listeners = [
        'EditUser' => 'edit',
        'DeleteUser' => 'softDelete',
    ];

    public function mount()
    {
        $this->authorizePermission('view user');

    }

    public function updatingSearch()
    {
        $this->resetPage(); // Resets pagination on search change
    }

    public function softDelete($id)
    {
        $this->authorizePermission('delete user');
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete(); // Soft delete the permissio

            LivewireAlert::title('User deleted successfully!')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();

            $this->redirect(route('admin.users.list'), true);

        } else {
            LivewireAlert::title('User not Found!')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }

    public function edit($id)
    {
        $this->authorizePermission('edit user');
        $this->redirect(route('admin.users.edit', $id), true);
    }


    public function render()
    {
        return view('livewire.admin.user.Index')
            ->layout('layouts.app');
    }
}
