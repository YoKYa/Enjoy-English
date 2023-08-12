<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Panswer as ModelsPanswer;
use Illuminate\Support\Facades\Validator;

class Panswer extends Component
{
    use WithFileUploads;
    public $modalAnswer = false;
    public $modalChoiceAnswer = false;
    public $practiceId, $no = 1, $answers;
    public $data, $pict, $audio;
    protected $listeners = ['modal'];
    public $saveAnswer;
    public $satu, $dua, $tiga, $empat;
    public $type = 1, $typeAnswer;
    public function render()
    {
        return view('livewire.admin.panswer');
    }
    public function modal($id = null){
        $this->modalAnswer = !$this->modalAnswer;
        $this->practiceId = $id;
        $this->data = null;
        $this->satu = null;
        $this->dua=null ;
        $this->tiga=null;
        $this->empat=null;
    }
    public function selectType($type){
        $this->type = $type;
        if ($this->type != 1) {
            $this->typeAnswer="text";
        }
    }
    public function selectTypeAnswer($type){
        $this->typeAnswer = $type;
        $this->data = null;
    }
    public function choiceAnswer($no) {
        $this->no = $no;
        $this->modalChoiceAnswer = true;
    }
    public function deletePicture() {
        $this->pict = null;
        $this->audio = null;
    }
    
    public function loadAnswer($no = null){
        if ($no == null) {
            return ModelsPanswer::where('practice_id', $this->practiceId)->get()->sortBy('nomor');
        }else{
            return ModelsPanswer::where('practice_id', $this->practiceId)->where('nomor', $no)->get();
        }
    }
    public function save(){
        if ($this->typeAnswer == 'picture') {
            try {
                $this->data = $this->pict->storeAs(
             'panswer/picture', Str::random(8).'.png');
            } catch (\Throwable $th) {
                //throw $th;
            }
        }else if($this->typeAnswer == 'audio'){
            try {
                $this->data = $this->audio->storeAs(
             'panswer/audio', Str::random(8).'.mp3');
            } catch (\Throwable $th) {
                //throw $th;
            }  
        }else if ($this->typeAnswer == 'text') {
            $this->data = strtoupper($this->data);
        }
        
        $answer = [
            "practice_id"       => $this->practiceId,
            "nomor"             => $this->no,
            "type"              => $this->type,
            "typeanswer"        => $this->typeAnswer,
            "data"              => $this->data,
        ];
        Validator::make($answer, [
            'practice_id' => ['required'],
            'nomor' => ['required','numeric'],
            'type' => ['required'],
            'typeanswer' => ['required'],
            'data' => ['required']
        ])->validateWithBag('add');
       
        ModelsPanswer::create($answer);
        if ($this->type == 2 || $this->type == 3) {
            $this->no++;
        }
        $this->data = '';
        $this->pict = null;
        $this->audio = null;
        $this->resetErrorBag();
    }
    public function saveAnswer(){
        try {
            if ($this->type == 3) {
                $answer = [
                    "answer"       => strtoupper($this->satu)
                ];
            }elseif($this->type == 4){
                $answer = [
                    "practice_id"       => $this->practiceId,
                    "nomor"             => $this->no,
                    "type"              => $this->type,
                    "typeanswer"        => $this->typeAnswer,
                    "answer"            => strtoupper($this->data),
                    "data"              => strtoupper($this->data),
                ];
                Validator::make($answer, [
                    'practice_id' => ['required'],
                    'nomor' => ['required','numeric'],
                    'type' => ['required'],
                    'typeanswer' => ['required'],
                    'data' => ['required']
                ])->validateWithBag('add');
                $data = ModelsPanswer::create($answer);
            }else{
                $answer = [
                    "answer"       => $this->satu.",".$this->dua.",".$this->tiga.",".$this->empat,
                ];
            }
           
            if ($this->type != 4) {
                $data = ModelsPanswer::where('practice_id', $this->practiceId)->get()->first();
            }
            $data->update($answer);
            session()->flash('answer', 'Successfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function maxAnswer(){
        return ModelsPanswer::where('practice_id', $this->practiceId)->get();
    }
}
