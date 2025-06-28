<?php

namespace App\Livewire\Tenant\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Tenant;

#[Title('Tenant Login Now')]
class Login extends Component
{
    public $phoneNumber;



    public function rules()
    {
        return [
            'phoneNumber' => 'required|string',
        ];
    }
    public function login()
    {
        $this->validate();

        $user = Tenant::where('phone', $this->phoneNumber)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phoneNumber' => 'Invalid phone number.',
            ]);
        }

        if ($user->status == 0) {
            throw ValidationException::withMessages([
                'message' => 'Your account has been blocked. Please contact the administrator.',
            ]);
        }

        // Log in manually
        Auth::guard('tenant')->login($user);
        session()->regenerate();
        session()->flash('success', 'Login successful!');
        return $this->redirect('/tenant/dashboard', true);

    }
    public function render()
    {
        return view('livewire.tenant.auth.login')->layout('layouts.tenant-guest');
    }
}
