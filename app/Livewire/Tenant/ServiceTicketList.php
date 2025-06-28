<?php

namespace App\Livewire\Tenant;

use App\Models\ServiceRequest;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

use Livewire\Attributes\Title;
#[Title('Our Service Ticket Lists')]
class ServiceTicketList extends Component
{
    public $showNoteModel = false;

    public $notes;

    // public $listeners = ['showNoteModel'];


    public function showNote($id)
    {
        try {
            $this->notes = ServiceRequest::with([
                'notes' => function ($q) {
                    $q->orderBy('id', 'desc');
                }
            ])
                ->whereHas('notes')
                ->findOrFail($id);
            $this->showNoteModel = true;

        } catch (\Throwable $th) {
            LivewireAlert::title($th->getMessage())
                ->warning()
                ->position('bottom-end')
                ->timer(5000)
                ->toast()
                ->show();
        }

    }


    public function render()
    {
        $serviceTickets = ServiceRequest::user()
            ->with(['tenant', 'notes'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.tenant.service-ticket-list', [
            'serviceTickets' => $serviceTickets,
        ])
            ->layout('layouts.tenant-app');
    }
}
