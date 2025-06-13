<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductManager extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $description, $price, $image, $image_url;
    public $imageInputType = 'upload';
    public $is_active = true;
    public $selectedProduct = null;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ];

        if ($this->imageInputType === 'upload') {
            $rules['image'] = $this->selectedProduct ? 'nullable|image|max:2048' : 'required|image|max:2048';
        } else {
            $rules['image_url'] = 'required|url|max:2048';
        }

        return $rules;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedImageInputType()
    {
        $this->image = null;
        $this->image_url = null;
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        $imageUrl = $this->image_url;

        if ($this->imageInputType === 'upload' && $this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        if ($this->selectedProduct) {
            $product = $this->selectedProduct;

            if ($this->imageInputType === 'upload' && $this->image && $product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'image_path' => $imagePath ?? $product->image_path,
                'image_url' => $this->imageInputType === 'url' ? $imageUrl : null,
                'is_active' => $this->is_active,
            ]);

            session()->flash('message', 'Producto actualizado correctamente.');
        } else {
            Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'image_path' => $imagePath,
                'image_url' => $this->imageInputType === 'url' ? $imageUrl : null,
                'is_active' => $this->is_active,
            ]);

            session()->flash('message', 'Producto creado correctamente.');
        }

        $this->resetInput();
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);

        $this->selectedProduct = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->is_active = $product->is_active;
        $this->imageInputType = $product->image_url ? 'url' : 'upload';
        $this->image_url = $product->image_url;
        $this->image = null;
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        session()->flash('message', 'Producto eliminado correctamente.');
        $this->resetPage();
    }

    public function resetInput()
    {
        $this->reset([
            'name', 'description', 'price', 'image', 'image_url',
            'selectedProduct', 'is_active'
        ]);
        $this->imageInputType = 'upload';
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('description', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('livewire.dashboard.product-manager', compact('products'));
    }
}


