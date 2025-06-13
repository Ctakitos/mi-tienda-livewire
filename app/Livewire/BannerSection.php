<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Banner;
class BannerSection extends Component
{
    public function render()
    {
        $banners = Banner::where('is_active', true)->get();
        return view('livewire.banner-section', compact('banners'));
    }
}


