<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductSection extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $selectedProduct = null;
    public $cart = [];

    public function selectProduct($productId)
    {   

        $this->selectedProduct = Product::find($productId);
    }

    public function resetSelectedProduct()
    {
        $this->selectedProduct = null;
    }

    public function addToCart($productId)
    {
        $this->cart[] = $productId;

        session()->flash('message', 'Producto agregado al carrito.');
        $this->dispatchBrowserEvent('cartUpdated', ['count' => count($this->cart)]);
    }

    public function render()
    {
        $products = Product::where('is_active', true)->latest()->paginate(9);
        return view('livewire.product-section', compact('products'));
    }
}
