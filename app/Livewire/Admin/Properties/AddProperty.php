<?php

namespace App\Livewire\Admin\Properties;

use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class AddProperty extends Component
{
    use \Livewire\WithFileUploads;
    public $show = false;
    protected $listeners = ['openAddressModal' => 'showModal'];

    public $propertyName, $propertyAddress, $renterName, $rentAmount, $lateFee, $dueDate, $email, $phone, $pinNumber;
    public $documents = [];

    public function showModal()
    {
        $this->show = true;
    }

    protected $rules = [
        'propertyName' => 'required|string|max:255',
        'propertyAddress' => 'required|string',
        'renterName' => 'required|string',
        'rentAmount' => 'required|numeric',
        'lateFee' => 'required|numeric',
        'dueDate' => 'required|date',
        'email' => 'required|email',
        'phone' => 'required|string',
        'documents.*' => 'file|max:2048|mimes:jpg,jpeg,png,pdf',// 2MB max per file, nullable to allow no documents
        'pinNumber' => 'nullable|string|max:255', // Optional pin number
    ];

    public function removeDocument($index)
    {
        $this->documents = collect($this->documents)->forget($index)->values()->all();
    }

    // public function uploadDocuments()
    // {
    //     foreach ($this->documents as $document) {
    //         $document->store('property-documents', 'public');
    //     }

    //     // session()->flash('message', 'Documents uploaded successfully.');
    //     $this->show = false; // Hide the modal after upload

    //     LivewireAlert::title('File uploaded successfully.')
    //         ->success()
    //         ->timer(5000)
    //         ->position('bottom-end')
    //         ->toast()
    //         ->show();
    //     $this->reset('documents');
    //     $this->redirect(route('admin.dashboard'), true);
    // }


    public function submit()
    {
        $this->validate();

        // Logic to save the property details
        // For example, you might save to a database or perform other actions

        // session()->flash('message', 'Property added successfully!');
        // $this->reset();
        // $this->show = false;
    }
    public function render()
    {
        return view('livewire.admin.properties.add-property');
    }
}
