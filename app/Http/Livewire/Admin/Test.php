<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\{Materi,Answer, Question, Test as ModelsTest};

class Test extends Component
{
    public $materi, $test, $slug;
    public $line;
    protected $listeners = ['loadMateri'];
    public function mount($slug){
        $this->slug = $slug;
        $this->loadMateri($slug);
    }
    public function render()
    {
        return view('livewire.admin.test');
    }
    // Load
    public function loadMateri() {
        $this->materi = Materi::where('slug', $this->slug)->first();
    }
    // Add Delete
    public function addNumber() {
        $this->test = ModelsTest::create([
            'materi_id' => $this->materi->id,
        ]);
        session()->flash('success', 'Successfully');
        $this->loadMateri();
    }
    public function deleteNumber($id){
        try {
            $this->test = ModelsTest::find($id);
            $this->test->delete();
            $this->loadMateri();
        } catch (\Throwable $th) {
           dd($th);
        }
        session()->flash('success','successfully deleted');
    }
    public function status($id){
        $question = Question::where('test_id', $id)->get();
        $answer = Answer::where('test_id', $id)->get();
        if ($question->count() > 0 && $answer->count() > 0) {
            return true;
        }else{
            return false;
        }
    }
}
