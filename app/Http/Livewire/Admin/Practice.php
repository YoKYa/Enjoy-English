<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Livewire\{Component, WithFileUploads};
use App\Models\{Materi, Panswer, Pquestion, Practice as ModelsPractice};

class Practice extends Component
{
    use WithFileUploads;
    public $materi;
    public $practices;
    public $practice;

    public function mount($slug){
        $this->loadData($slug);
    }
    function loadData($slug) {
        $this->materi = Materi::where('slug', $slug)->first();
        $this->practices = ModelsPractice::where('materi_id', $this->materi->id)->get();
    }
    public function render()
    {
        return view('livewire.admin.practice');
    }
    public function typePractice($type){
        $this->practice->update([
            'type' => $type
        ]);
        $this->loadData($this->materi->slug);
    }
    public function addPractice(){
        $this->practice = ModelsPractice::create([
            'materi_id' => $this->materi->id,
        ]);
        $this->line = 1;
        $this->loadData($this->materi->slug);
    }
    public function deletePractice($id = null){
        if ($id == null) {
            $practice = $this->practice;
        }else{
            $practice = ModelsPractice::find($id);
        }
       try {
         $practice->delete();  
        $this->loadData($this->materi->slug);
       } catch (\Throwable $th) {
        //throw $th;
       }
    }
    public function deletePicture() {
        $this->data = null;
    }

    // Question
    public $addTextModal= false;
    public $addPictureModal= false;
    public $addAudioModal= false;
    public $data, $type, $line;
    public $question;

    
    public function addQuestion($type){
        $this->type = $type;
        if ($type == 'text') {
            $this->addTextModal = !$this->addTextModal;
        }else if ($type == 'picture') {
            $this->addPictureModal = !$this->addPictureModal;
        }else if ($type == 'audio'){
            $this->addAudioModal = !$this->addAudioModal ;
        }
    }
    public function saveQuestion(){
        if ($this->type == 'picture') {
            $this->data = $this->data->storeAs(
             '/pquestion/picture', Str::random(8).'.png');
        }else if($this->type == 'audio'){
            $this->data = $this->data->storeAs(
             '/pquestion/audio', Str::random(8).'.mp3');
        }
        Validator::make([
            'line' => $this->line,
            'data' => $this->data
        ], [
            'line' => ['required'],
            'data' => ['required'],
        ])->validateWithBag('question');

        Pquestion::create([
            'practice_id' => $this->practice->id,
            'type' => $this->type,
            'line' => $this->line,
            'data' => $this->data
        ]);
        $this->type = null;
        $this->data = null;
        $this->addTextModal= false;
        $this->addPictureModal= false;
        $this->addAudioModal= false;
        $this->resetErrorBag();
        $this->loadData($this->materi->slug);
        $this->practice = ModelsPractice::find($this->practice->id);
    }
    public function checkAnswer($id, $type) {
        $data = Panswer::where('practice_id', $id)->get()->first(); 
        if ($type == "speaking") {
            return true;
        }else{
            if ($data == null) {
                return false;
            }else{
                if ($data->answer == null) {
                    if ($data->type == 2) {
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return true;
                }
            }
        }
    }

}
