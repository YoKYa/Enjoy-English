<?php

namespace App\Http\Livewire;

use App\Models\Materi;
use Livewire\Component;

class Lessons extends Component
{
    public $materi;
    public function mount($slug){
        
        $this->materi = Materi::where('slug', $slug)->first();
    }
    public function render()
    {
        return view('livewire.lessons')->layout('layouts.app-materi');
    }
}
