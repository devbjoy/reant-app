<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\HasPermissionCheck;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Title('Edit User')]
class EditUser extends Component
{
    use WithPagination, HasPermissionCheck;
    public $userId; // Used for editing an existing permission
    public $name;
    public $status;

    public $email;

    public $seletedRole = []; // Array to hold selected permissions

    public function mount($id)
    {
        $this->authorizePermission('edit user'); // Check permission to edit user
        $user = User::findOrFail($id);
        if ($user) {
            $this->userId = $user->id; // Set the user ID for editing
            $this->name = $user->name;
            $this->email = $user->email;
            $this->status = $user->status;
            $this->seletedRole = $user->roles()->pluck('id')->toArray(); // Get the roles associated with the user
        } else {
            LivewireAlert::title('User not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            $this->redirect(route('admin.users.list'), true);
        }

    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'status' => 'nullable|boolean',
            'seletedRole' => 'nullable|array',
            'seletedRole.*' => 'exists:roles,id',
        ];
    }



    public function updateUser()
    {
        $this->validate();
        // For example, using a model:
        $user = User::findOrFail($this->userId);
        if (!$user) {
            LivewireAlert::title('User not found.')
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            return;
        }

        $user->name = $this->name;
        $user->email = $this->email;
        $user->status = $this->status; // Convert status to integer
        $user->save(); // Save the user to the database

        // Attach selected permissions to the role
        if (!empty($this->seletedRole)) {
            $user->roles()->sync($this->seletedRole);
        }

        LivewireAlert::title('User updated successfully!')
            ->success()
            ->timer(5000)
            ->position('bottom-end')
            ->toast()
            ->show();

        $this->redirect(route('admin.users.list'), true);
        // Optionally reset the form fields
        $this->reset(['name', 'status', 'email', 'seletedRole']);
    }

    public function render()
    {
        $roles = Role::active()->latest()->get(); // Fetch all permissions for the dropdown
        return view('livewire.admin.user.Edit', compact('roles'))->layout('layouts.app');
    }
}
