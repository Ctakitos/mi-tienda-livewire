<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Service;

class ServiceManager extends Component
{
    public $name, $description, $price;
    


    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|numeric|min:0',
    ];

    public function save()
    {
        $this->validate();

        Service::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'is_active' => true,
        ]);

        session()->flash('message', 'Servicio creado correctamente.');
        $this->reset(['name', 'description', 'price']);
    }


    public function render()
    {
        $services = Service::latest()->get();
        return view('livewire.dashboard.service-manager', compact('services'));
    }
}



