<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Profile')]
class Porfile extends Component
{
    use WithFileUploads;


    public $username, $email, $profile_image, $preview_image, $old_password, $new_password, $confirm_password;

    public function removeTempImage()
    {
        if ($this->preview_image) {
            $this->preview_image = null;
            LivewireAlert::success()
                ->title('Preview Image Remove successfully')
                ->timer(5000)
                ->toast()
                ->position('bottom-end')
                ->show();
        } else {
            LivewireAlert::warning()
                ->title('Preview image not found')
                ->timer(5000)
                ->toast()
                ->position('bottom-end')
                ->show();
        }

    }
    public function mount()
    {
        // Initialize properties if needed, e.g., fetching user data
        $this->username = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->profile_image = auth()->user()->profile_image; // Assuming this field exists
    }

    public function UpdateInfo()
    {
        try {
            $this->validate([
                'email' => 'required|email|unique:users,email,' . auth()->user()->id,
                'username' => 'required|string|max:255',
                'preview_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',//2 MB
            ]);

            $user = auth()->user();
            $user->email = $this->email;
            $user->name = $this->username;
            if ($this->preview_image) {
                // remove the old image if exists
                if ($user->profile_image) {
                    \Storage::disk('public')->delete($user->profile_image);
                }
                // Store the new image
                $user->profile_image = $this->preview_image->store('admin/company-setting', 'public');
            }
            $user->save();

            $this->preview_image = null; // Reset the preview image after saving

            LivewireAlert::title('Email and User name updated successfully')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();

        } catch (\Exception $e) {
            LivewireAlert::title($e->getMessage())
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }

    }

    public function changePassword()
    {

        try {
            $this->validate([
                'old_password' => 'required|string|min:6',
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'same:new_password',
            ]);

            $user = auth()->user();

            if (!\Hash::check($this->old_password, $user->password)) {
                throw new \Exception('Old password is incorrect.');
            }

            $user->password = \Hash::make($this->new_password);
            $user->save();

            $this->old_password = '';
            $this->new_password = '';
            $this->confirm_password = '';

            auth()->logout(); // Log out the user
            session()->invalidate(); // Invalidate the session
            session()->regenerateToken();
            return redirect()->route('admin.login')->with('message', 'Password changed successfully. Please log in again.');


        } catch (\Throwable $th) {
            LivewireAlert::title($th->getMessage())
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
        }
    }
    public function render()
    {
        return view('livewire.admin.porfile');
    }
}
