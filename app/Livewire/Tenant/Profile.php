<?php

namespace App\Livewire\Tenant;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Type\Integer;

#[Title('Profile Info')]
class Profile extends Component
{
    use WithFileUploads;


    public $first_name, $last_name, $phone_number, $pin, $email, $profile_image, $preview_image, $old_password, $new_password, $confirm_password;

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
                ->title('This image not removeable')
                ->timer(5000)
                ->toast()
                ->position('bottom-end')
                ->show();
        }

    }
    public function mount()
    {
        $user = auth()->guard('tenant')->user();
        // Initialize properties if needed, e.g., fetching user data
        $this->first_name = $user?->first_name;
        $this->last_name = $user?->last_name;
        $this->phone_number = $user?->phone;
        $this->pin = $user?->pin_number;
        $this->email = $user?->email;
        $this->profile_image = $user->profile_image; // Assuming this field exists
    }

    public function UpdateProfileInfo()
    {
        try {
            $this->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:15|unique:tenants,phone,' . auth()->guard('tenant')->user()->id,
                'pin' => 'required|min:6|max:8|unique:tenants,pin_number,' . auth()->guard('tenant')->user()->id,
                'email' => 'required|email|unique:tenants,email,' . auth()->guard('tenant')->user()->id,
                'preview_image' => 'nullable|mimes:png,jpg,jpeg|max:2048',//2 MB
            ]);

            $user = auth()->guard('tenant')->user();
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->phone = $this->phone_number;
            $user->pin_number = $this->pin;
            $user->email = $this->email;
            if ($this->preview_image) {
                // remove the old image if exists
                if ($user->image) {
                    \Storage::disk('public')->delete($user->profile_image);
                }
                // Store the new image
                $user->image = $this->preview_image->store('tenant/images', 'public');
            }
            $user->save();

            $this->preview_image = null; // Reset the preview image after saving

            LivewireAlert::title('Profile updated successfully')
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
                'old_password' => 'required|string|min:6|max:255',
                'new_password' => 'required|string|min:6|max:255|different:old_password',
                'confirm_password' => 'same:new_password',
            ]);

            $user = auth()->guard('tenant')->user();

            if (!\Hash::check($this->old_password, $user->password)) {
                throw new \Exception('Old password is incorrect.');
            }

            $user->password = \Hash::make($this->new_password);
            $user->save();

            $this->old_password = '';
            $this->new_password = '';
            $this->confirm_password = '';

            auth()->guard('tenant')->logout(); // Log out the user
            session()->invalidate(); // Invalidate the session
            session()->regenerateToken();
            return redirect()->route('tenant.login')->with('message', 'Password changed successfully. Please log in again.');


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
        return view('livewire.tenant.porfile')
            ->layout('layouts.tenant-app');
    }
}
