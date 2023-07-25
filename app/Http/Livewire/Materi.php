<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Materi extends Component
{
    public function mount($id) 
    {
        dd($id);
    }
    public function render()
    {
        return view('livewire.materi');
    }
}
