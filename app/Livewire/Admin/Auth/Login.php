<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

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
        dd('hello');
        $this->validate();

        if (
            !Auth::attempt(
                ['email' => $this->email, 'password' => $this->password],
                $this->remember
            )
        ) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        session()->regenerate();

        return redirect()->intended('/admin/dashboard');
    }
    public function render()
    {
        return view('livewire.admin.auth.login')->layout('layouts.admin-guest');
    }
}
