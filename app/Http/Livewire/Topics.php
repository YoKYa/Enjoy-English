<?php

namespace App\Http\Livewire;

use App\Models\Topic;
use Livewire\Component;

class Topics extends Component
{
    public $topics;

    public function render()
    {
        $this->loadTopics();
        return view('livewire.topics');
    }
    public function loadTopics(){
        $this->topics = Topic::get();
    }
}
