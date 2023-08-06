<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Livewire\{Component, WithFileUploads};
use App\Models\{Question as ModelQuestion, Test};

class Question extends Component
{
    use WithFileUploads;
    public $test;
    public $modalQuestion = false;
    public $toggleType;
    public $data, $line = 1;
    public $selectedLine;
    protected $listeners = ['modal'];
    public function render()
    {
        return view('livewire.admin.question');
    }
    public function modal($id = null){
        $this->modalQuestion = !$this->modalQuestion;
        if ($id != null) {
            $this->test = Test::find($id);
        }
        $this->getSelectedLine();
        $this->line =1;
         $this->toggleType = 'text';
        $this->emit('loadMateri');
    }
    public function getSelectedLine() {
        $this->selectedLine = ModelQuestion::where('test_id', $this->test->id)->max('line');
    }
    public function selectTypeQuestion($type) {
        if ($type == "text") {
            $this->toggleType = $type;
        }else if ($type == "audio") {
            $this->toggleType = $type;
        }else if ($type == "picture") {
            $this->toggleType = $type;
        }
    }
    public function deletePicture() {
        $this->data = null;
    }
    public function saveQuestion(){
        if ($this->toggleType == 'picture') {
            try {
                 $this->data = $this->data->storeAs(
             '/question/picture', Str::random(8).'.png');
            } catch (\Throwable $th) {
                //throw $th;
            }
           
        }else if($this->toggleType == 'audio'){
            try {
               $this->data = $this->data->storeAs(
             '/question/audio', Str::random(8).'.mp3');
            } catch (\Throwable $th) {
                //throw $th;
            }
            
        }
        Validator::make([
            'line' => $this->line,
            'data' => $this->data
        ], [
            'line' => ['required'],
            'data' => ['required'],
        ])->validateWithBag('question');

        ModelQuestion::create([
            'test_id' => $this->test->id,
            'type' =>$this->toggleType,
            'line' => $this->line,
            'data' => $this->data
        ]);
        session()->flash('success', 'Successfully');
        $this->getSelectedLine();
        $this->data = null;
        $this->resetErrorBag();
    }
    public function getQuestion($line) {
        return ModelQuestion::where('test_id', $this->test->id)->where('line',$line)->get();
    }
}
