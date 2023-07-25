<?php

namespace App\Http\Livewire\Admin;

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
        return view('livewire.admin.lessons');
    }
}
