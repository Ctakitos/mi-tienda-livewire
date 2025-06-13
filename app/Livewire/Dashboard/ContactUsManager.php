<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\StaticContent;

class ContactUsManager extends Component
{
    public $content;

    public function mount()
    {
        $this->content = StaticContent::firstOrCreate(
            ['section' => 'contact'],
            ['content' => '']
        )->content;
    }

    public function save()
    {   

        logger('Contenido a guardar: ' . $this->content);
        
        StaticContent::updateOrCreate(
            ['section' => 'contact'],
            ['content' => $this->content]
        );

        session()->flash('message', 'Contenido de contacto actualizado.');
    }

    public function render()
    {
        return view('livewire.dashboard.contact-us-manager');
    }
}

