<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;

class ServiceSection extends Component
{
    public function render()
    {
        $services = Service::where('is_active', true)->get();
        return view('livewire.service-section', compact('services'));
    }
}
