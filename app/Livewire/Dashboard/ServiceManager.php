<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;


class ServiceManager extends Component
{
    use WithFileUploads, WithPagination;

    public $name, $description, $price, $is_active = true;
    public $image, $image_url, $imageInputType = 'upload';
    public $selectedService = null;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ];

        if ($this->imageInputType === 'upload') {
            $rules['image'] = $this->selectedService ? 'nullable|image|max:2048' : 'required|image|max:2048';
        } else {
            $rules['image_url'] = 'required|url|max:2048';
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;

        if ($this->imageInputType === 'upload' && $this->image) {
            $imagePath = $this->image->store('services', 'public');
        }

        if ($this->selectedService) {
            // Eliminar imagen anterior si se sube una nueva
            if ($this->imageInputType === 'upload' && $this->image && $this->selectedService->image_path) {
                Storage::disk('public')->delete($this->selectedService->image_path);
            }

            $this->selectedService->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'is_active' => $this->is_active,
                'image_path' => $imagePath ?? $this->selectedService->image_path,
                'image_url' => $this->imageInputType === 'url' ? $this->image_url : null,
            ]);

            session()->flash('message', 'Servicio actualizado correctamente.');
        } else {
            Service::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'is_active' => $this->is_active,
                'image_path' => $imagePath,
                'image_url' => $this->imageInputType === 'url' ? $this->image_url : null,
            ]);

            session()->flash('message', 'Servicio creado correctamente.');
        }

        $this->resetInput();
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $this->selectedService = $service;

        $this->name = $service->name;
        $this->description = $service->description;
        $this->price = $service->price;
        $this->is_active = $service->is_active;
        $this->imageInputType = $service->image_url ? 'url' : 'upload';
        $this->image_url = $service->image_url;
        $this->image = null;
    }

    public function delete($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image_path) {
            Storage::disk('public')->delete($service->image_path);
        }

        $service->delete();

        session()->flash('message', 'Servicio eliminado correctamente.');
    }

    public function resetInput()
    {
        $this->reset([
            'name', 'description', 'price', 'is_active',
            'image', 'image_url', 'imageInputType', 'selectedService'
        ]);
        $this->imageInputType = 'upload';
    }

    public function render()
    {
        $services = Service::latest()->paginate(10);
        return view('livewire.dashboard.service-manager', compact('services'));
    }
}
