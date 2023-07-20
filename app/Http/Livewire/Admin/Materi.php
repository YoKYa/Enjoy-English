<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Materi extends Component
{
    public function mount($slug) 
    {
        dd($slug);
    }
    public function render()
    {
        return view('livewire.admin.materi');
    }
}
