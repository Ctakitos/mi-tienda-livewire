<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
