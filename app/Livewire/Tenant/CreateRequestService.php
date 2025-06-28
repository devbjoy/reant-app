<?php

namespace App\Livewire\Tenant;

use App\Mail\ServiceTicket;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithFileUploads;

#[Title('Create Request Service')]
class CreateRequestService extends Component
{
    use WithFileUploads;

    public $category, $description, $other_category;

    public $documents = [];

    public function createServiceTicket()
    {
        try {
            $this->validate([
                'category' => 'required|string',
                'description' => 'required|string',
                'other_category' => $this->category === 'Other' ? 'required|string|max:255' : 'nullable',
                'documents.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048', // max 2MB for each file
            ]);

            $imagePaths = [];

            if ($this->documents) {
                foreach ($this->documents as $image) {
                    $imagePaths[] = $image->store('tenant/service-images', 'public');
                }
            }

            $serviceRequest = ServiceRequest::create([
                'category' => $this->category === 'Other' ? $this->other_category : $this->category,
                'description' => $this->description,
                'status' => 'Open',
                'images' => json_encode($imagePaths),
                'tenant_id' => auth()->guard('tenant')->user()->id,
            ]);

            $data = [
                'title' => $this->other_category ?? $this->category,
                'message' => $this->description,
                'email' => auth()->guard('tenant')->user()->email
            ];

            Mail::to('admin@example.com')->send(new ServiceTicket($data));

            LivewireAlert::title(title: 'Service repiar ticket created successfully.')
                ->success()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            $this->reset(['category', 'description', 'other_category', 'documents']);

        } catch (\Exception $e) {
            LivewireAlert::title($e->getMessage())
                ->error()
                ->timer(5000)
                ->position('bottom-end')
                ->toast()
                ->show();
            return;
        }





    }

    public function removeDocument($index)
    {
        $this->documents = collect($this->documents)->forget($index)->values()->all();
        LivewireAlert::title('Document removed successfully.')
            ->success()
            ->timer(5000)
            ->position('bottom-end')
            ->toast()
            ->show();
    }

    public function render()
    {
        return view('livewire.tenant.create-request-service')->layout('layouts.tenant-app');
    }
}
