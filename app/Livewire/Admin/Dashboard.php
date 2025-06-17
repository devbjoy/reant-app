<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Title('Dashboard')]
class Dashboard extends Component
{
    use WithFileUploads;

    public $properties;
    public $showForm = false;

    // Form fields
    public $propertyName, $propertyAddress, $renterName, $rentAmount, $lateFee, $dueDate, $email, $phone, $pinNumber;
    public $documents = [];

    protected $rules = [
        'propertyName' => 'required|string|max:255',
        'propertyAddress' => 'required|string',
        'renterName' => 'required|string',
        'rentAmount' => 'required|numeric',
        'lateFee' => 'required|numeric',
        'dueDate' => 'required|date',
        'email' => 'required|email',
        'phone' => 'required|string',
        'documents.*' => 'file|max:10240' // 10MB max per file
    ];

    // public function openPropertyModal()
    // {
    //     // dd('Opening property modal');
    //     $this->dispatch('openPropertyModal');
    // }

    // public function mount()
    // {
    //     $this->loadProperties();
    // }

    // public function loadProperties()
    // {
    //     $this->properties = User::with('tenant')->get();
    // }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    // public function addProperty()
    // {
    //     $this->validate();

    //     $property = User::create([
    //         'name' => $this->propertyName,
    //         'address' => $this->propertyAddress,
    //         'rent_amount' => $this->rentAmount,
    //         'late_fee' => $this->lateFee,
    //         'due_date' => $this->dueDate,
    //     ]);

    //     $tenant = $property->tenant()->create([
    //         'name' => $this->renterName,
    //         'email' => $this->email,
    //         'phone' => $this->phone,
    //         'pin_number' => $this->pinNumber,
    //     ]);

    //     foreach ($this->documents as $document) {
    //         $path = $document->store('documents');
    //         $property->documents()->create(['file_path' => $path]);
    //     }

    //     $this->resetForm();
    //     $this->loadProperties();
    //     $this->showForm = false;
    // }

    public function resetForm()
    {
        $this->reset(['propertyName', 'propertyAddress', 'renterName', 'rentAmount', 'lateFee', 'dueDate', 'email', 'phone', 'pinNumber', 'documents']);
    }


    public function render()
    {
        return view('livewire.admin.dashboard')->layout('layouts.app');
    }

    // public function markAsPaid($propertyId)
    // {
    //     $property = Property::find($propertyId);
    //     $property->update(['last_paid_at' => now()]);

    //     $tenant = $property->tenant;

    //     // Send receipt via email and SMS
    //     Notification::route('mail', $tenant->email)
    //         ->route('nexmo', $tenant->phone)
    //         ->notify(new PaymentReceiptNotification($property));
    // }

    // public function getStatusColor($dueDate, $lastPaidAt)
    // {
    //     if ($lastPaidAt && Carbon::parse($lastPaidAt)->gte(Carbon::parse($dueDate))) {
    //         return 'green';
    //     }

    //     if (Carbon::now()->diffInDays(Carbon::parse($dueDate), false) <= 7 && Carbon::now()->lte(Carbon::parse($dueDate))) {
    //         return 'purple';
    //     }

    //     return 'red';
    // }
}
