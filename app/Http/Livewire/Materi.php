<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Materi extends Component
{
    public function mount($slug) 
    {
        dd($slug);
    }
    public function render()
    {
        return view('livewire.materi');
    }
}
