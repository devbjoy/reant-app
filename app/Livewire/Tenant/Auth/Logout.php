<?php

namespace App\Livewire\Tenant\Auth;

use Livewire\Component;

class Logout extends Component
{
    protected $listeners = ['logout' => 'logout']; // Listen for the logout event
    public function logout()
    {
        auth()->guard('tenant')->logout(); // Log out the user
        session()->invalidate(); // Invalidate the session
        session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('tenant.login'); // Redirect to the login page
    }
    public function render()
    {
        return view('livewire.tenant.auth.logout');
    }
}
