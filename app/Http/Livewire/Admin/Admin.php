<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Admin extends Component
{
    
    public function mount()
    {
        if (Auth::user()->roles == 'user') {
            redirect('dashboard');
        }
    }
    public function render()
    {
        return view('livewire.admin.admin');
    }
}
