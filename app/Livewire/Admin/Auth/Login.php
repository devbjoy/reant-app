<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login Now')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }
    public function loginSave()
    {
        $this->validate();

        if (
            Auth::attempt([
                'email' => $this->email,
                'password' => $this->password,
            ], $this->remember)
        ) {
            if (Auth::user()->status == 0) {
                Auth::logout();

                throw ValidationException::withMessages([
                    'message' => 'Your account has been blocked. Please contact the administrator.',
                ]);
            }
            session()->regenerate();
            session()->flash('success', 'Login successful!');
            return $this->redirect('/admin/dashboard', true);
        } else {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

    }
    public function render()
    {
        return view('livewire.admin.auth.login')->layout('layouts.admin-guest');
    }
}
