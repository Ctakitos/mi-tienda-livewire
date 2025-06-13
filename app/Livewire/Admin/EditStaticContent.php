<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\StaticContent;

class EditStaticContent extends Component
{
    public $section;
    public $content;

    protected $rules = [
    'content' => 'required|string|min:10',
];

    public function mount($section)
    {
        $record = StaticContent::firstOrCreate(['section' => $section], ['content' => '']);
        $this->section = $section;
        $this->content = $record->content;
    }

    public function save()
    {   

        $this->validate();
        
        StaticContent::updateOrCreate(
            ['section' => $this->section],
            ['content' => $this->content]
        );

        session()->flash('message', 'Contenido actualizado correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.edit-static-content');
    }
}



