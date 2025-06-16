<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Traits\HasPermissionCheck;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Title('Trashed User List')]
class TrashedUser extends Component
{
    use WithPagination, HasPermissionCheck;
    public $search = '';

    protected $listeners = [
        'RestoreData' => 'restore',
        'ForceDelete' => 'forceDelete',
    ];
    public function mount()
    {
        $this->authorizePermission('view user trash');
    }
    public function restore($id)
    {
        $this->authorizePermission('restore user');
        $user = User::withTrashed()->findOrFail($id);
        if ($user) {
            $user->restore(); // Restore the soft-deleted role
            LivewireAlert::title('User restored successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast(true)
                ->show();

            $this->redirect(route('admin.users.trash'), true);
        } else {
            LivewireAlert::title('User not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }
    public function forceDelete($id)
    {
        $this->authorizePermission('force delete user');
        $user = User::withTrashed()->findOrFail($id);
        if ($user) {
            $user->roles()->detach(); // Removes all related permission links from pivot table
            $user->forceDelete(); // Permanently delete the role
            LivewireAlert::title('User permanently deleted successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast(true)
                ->show();

            $this->redirect(route('admin.users.trash'), true);
        } else {
            LivewireAlert::title('User not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }
    public function render()
    {
        return view('livewire.admin.user.Trash')
            ->layout('layouts.app');
    }
}
