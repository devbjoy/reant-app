<?php

namespace App\Livewire\Tenant;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Tenant Home')]
class Dashboard extends Component
{

    public function render()
    {
        return view('livewire.tenant.dashboard')->layout('layouts.tenant-app');
    }
}
