<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerManager extends Component
{
    use WithFileUploads, WithPagination;

    public $title, $description;
    public $image; // archivo local
    public $image_url; // url externa
    public $selectedBannerId = null;
    public $search = '';
    public $imageInputType = 'upload';

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        if ($this->imageInputType === 'upload') {
            $rules['image'] = 'required|image|max:2048';
        } else {
            $rules['image_url'] = 'required|url|max:2048';
        }

        return $rules;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        $imageUrl = null;

        if ($this->imageInputType === 'upload') {
            $imagePath = $this->image->store('banners', 'public');
        } else {
            $imageUrl = $this->image_url;
        }

        Banner::create([
            'title' => $this->title,
            'description' => $this->description,
            'image_path' => $imagePath,
            'image_url' => $imageUrl,
            'is_active' => true,
        ]);

        session()->flash('message', 'Banner creado correctamente.');
        $this->resetForm();
    }

    public function update()
    {
        $this->validate();

        $banner = Banner::findOrFail($this->selectedBannerId);

        // Eliminar imagen anterior si se reemplaza por una nueva local
        if ($this->imageInputType === 'upload' && $this->image) {
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }

            $banner->image_path = $this->image->store('banners', 'public');
            $banner->image_url = null;

        } elseif ($this->imageInputType === 'url') {
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }

            $banner->image_url = $this->image_url;
            $banner->image_path = null;
        }

        $banner->title = $this->title;
        $banner->description = $this->description;
        $banner->save();

        session()->flash('message', 'Banner actualizado correctamente.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        $this->selectedBannerId = $banner->id;
        $this->title = $banner->title;
        $this->description = $banner->description;
        $this->image_url = $banner->image_url;
        $this->image = null;
        $this->imageInputType = $banner->image_url ? 'url' : 'upload';
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    public function toggleStatus($id)
    {
        $banner = Banner::find($id);
        if (!$banner) return;

        if (!$banner->is_active && Banner::where('is_active', true)->count() >= 5) {
            session()->flash('message', 'No puedes activar más de 5 banners a la vez.');
            return;
        }

        $banner->is_active = !$banner->is_active;
        $banner->save();
    }

    public function delete($id)
    {
        $banner = Banner::find($id);
        if (!$banner) return;

        if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();
        session()->flash('message', 'Banner eliminado correctamente.');
    }

    private function resetForm()
    {
        $this->reset(['title', 'description', 'image', 'image_url', 'selectedBannerId']);
        $this->imageInputType = 'upload';
    }

    public function render()
    {
        $banners = Banner::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.dashboard.banner-manager', compact('banners'));
    }
}