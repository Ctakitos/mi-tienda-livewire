<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;

class ServiceSection extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedService = null;

    public function selectService($serviceId)
    {
        $this->selectedService = Service::find($serviceId);
    }

    public function resetSelectedService()
    {
        $this->selectedService = null;
    }

    
    public function render()
    {
        $services = Service::where('is_active', true)
            ->latest()
            ->paginate(6); // Puedes ajustar este valor

        return view('livewire.service-section', compact('services'));
    }
}




