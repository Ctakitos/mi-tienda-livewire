<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\StaticContent;

class ContactUs extends Component
{
    public function render()
    {   
        $content = StaticContent::where('section', 'contact')->value('content');
        return view('livewire.admin.contact-us', compact('content'));
    }
}







