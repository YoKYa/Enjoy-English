<?php

namespace App\Http\Livewire;

use App\Models\{Topic, Materi as ModelsMateri};
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Materi extends Component
{
    public $topic, $materis;
    public function mount($id) 
    {
    $this->topic = Topic::find($id);
       $this->materis = ModelsMateri::where('topic_id', $id)->where('publish', true)->get();
    }
    public function render()
    {
        return view('livewire.materi');
    }
}
