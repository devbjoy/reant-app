<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('UnAuthorize Access')]
class Error404 extends Component
{

    public function render()
    {
        // Fetch all permissions for the dropdown
        return view('livewire.Error404')->layout('layouts.app');
    }
}
