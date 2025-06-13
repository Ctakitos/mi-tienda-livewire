<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\StaticContent;

class AboutUs extends Component
{
    public function render()
    {
        $content = StaticContent::where('section', 'about')->value('content');
    return view('livewire.admin.about-us', compact('content'));
    }
}
