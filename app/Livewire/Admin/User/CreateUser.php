<?php

namespace App\Livewire\Admin\User;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\HasPermissionCheck;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;



#[Title('Create User')]
class CreateUser extends Component
{
    use WithPagination, HasPermissionCheck;
    // public $roleId = null; // Used for editing an existing permission
    public $name;
    public $status;

    public $email;

    public $password;

    public $confirmPassword;

    public $seletedRole = []; // Array to hold selected permissions

    public function mount()
    {
        $this->authorizePermission('add user'); // Check permission to add user
    }
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|unique:users,email|max:255',
        'password' => 'required|min:8|max:255|',
        'confirmPassword' => 'same:password',
        'status' => 'nullable|boolean', // Ensure status is a boolean
        'seletedRole' => 'nullable|array',
        'seletedRole.*' => 'exists:roles,id', // Validate each selected role exists in the roles table
    ];



    public function createUser()
    {
        // Validate the form data
        $this->validate();
        // For example, using a model:
        $user = new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->status = $this->status; // Convert status to integer
        $user->save(); // Save the user to the database

        // Attach selected permissions to the role
        if (!empty($this->seletedRole)) {
            $user->roles()->attach($this->seletedRole);
        }

        // Code to show a success message


        // session()->flash('message', 'User created successfully.');
        LivewireAlert::title('User created successfully!')
            ->success()
            ->timer(5000)
            ->position('bottom-end')
            ->toast()
            ->show();

        $this->redirect(route('admin.users.list'), true);
        // Optionally reset the form fields
        $this->reset(['name', 'status', 'email', 'password', 'confirmPassword', 'seletedRole']);
    }

    public function render()
    {
        $roles = Role::active()->latest()->get(); // Fetch all permissions for the dropdown
        return view('livewire.admin.user.Create', compact('roles'))->layout('layouts.app');
    }
}
