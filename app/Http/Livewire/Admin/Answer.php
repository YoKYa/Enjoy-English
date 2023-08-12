<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Livewire\{Component, WithFileUploads};
use App\Models\{Test, Answer as ModelAnswer};

class Answer extends Component
{
    use WithFileUploads;
    public $test;
    public $data,$no, $pict, $audio;
    public $satu, $dua, $tiga, $empat;
    public $toggleTypeAnswer, $toggleTypeData;
    public $modalAnswer = false;
    protected $listeners = ['modalA'];
    public function render()
    {
        return view('livewire.admin.answer');
    }
    public function modalA($id = null){
        $this->modalAnswer = !$this->modalAnswer;
        if ($id != null) {
            $this->test = Test::find($id);
        }
        $this->satu = null;
        $this->dua=null ;
        $this->tiga=null;
        $this->empat=null;
        $this->no = 1;
        $this->emit('loadMateri');
    }
    public function selectTypeAnswer($type) {
        $this->toggleTypeAnswer = $type;
        if ($this->toggleTypeAnswer != 1) {
            $this->toggleTypeData="text";
            $this->no = ModelAnswer::where('test_id', $this->test->id)->max('nomor') + 1;
        }
        $this->data = null;
    }
    public function selectTypeData($type) {
        $this->toggleTypeData = $type;
    }
    public function loadAnswer($no = null){
        if ($no == null) {
            return ModelAnswer::where('test_id', $this->test->id)->get()->sortBy('nomor');
        }else{
            return ModelAnswer::where('test_id', $this->test->id)->where('nomor', $no)->get();
        }
    }
     public function choiceAnswer($no) {
        $this->no = $no;
        $this->data = null;
    }
    public function save(){
        if ($this->toggleTypeData == 'picture') {
            try {
                $this->data = $this->pict->storeAs(
             'answer/picture', Str::random(8).'.png');
            } catch (\Throwable $th) {
                //throw $th;
            }
        }else if($this->toggleTypeData == 'audio'){
            try {
                $this->data = $this->audio->storeAs(
             'answer/audio', Str::random(8).'.mp3');
            } catch (\Throwable $th) {
                //throw $th;
            }  
        }else if($this->toggleTypeData == 'text'){
            $this->data = strtoupper($this->data);;
        }
        $answer = [
            "test_id"       => $this->test->id,
            "nomor"             => $this->no,
            "type"              => $this->toggleTypeAnswer,
            "typeanswer"        => $this->toggleTypeData,
            "data"              => $this->data,
        ];
        Validator::make($answer, [
            'test_id' => ['required'],
            'nomor' => ['required','numeric'],
            'type' => ['required'],
            'typeanswer' => ['required'],
            'data' => ['required']
        ])->validateWithBag('add');
       
        try {
            ModelAnswer::create($answer);
            if ($this->toggleTypeAnswer == 2 || $this->toggleTypeAnswer == 3) {
                $this->no++;
            }
            session()->flash('success', 'Successfully');
        } catch (\Throwable $th) {
            dd($th);
        }
        $this->data = null;
         $this->pict = null;
          $this->audio = null;
        $this->resetErrorBag();
    }
    public function saveAnswer(){
        try {
            if ($this->toggleTypeAnswer == 3) {
                $answer = [
                    "answer"       => strtoupper($this->satu)
                ];
            }elseif($this->toggleTypeAnswer == 4){
                $answer = [
                    "test_id"       => $this->test->id,
                    "nomor"             => $this->no,
                    "type"              => $this->toggleTypeAnswer,
                    "typeanswer"        => $this->toggleTypeData,
                    "answer"            => strtoupper($this->data),
                    "data"              => strtoupper($this->data),
                ];
                Validator::make($answer, [
                    'test_id' => ['required'],
                    'nomor' => ['required','numeric'],
                    'type' => ['required'],
                    'typeanswer' => ['required'],
                    'data' => ['required']
                ])->validateWithBag('add');
                $data = ModelAnswer::create($answer);
            }else{
                $answer = [
                    "answer"       => $this->satu.",".$this->dua.",".$this->tiga.",".$this->empat,
                ];
            }
           
            if ($this->toggleTypeAnswer != 4) {
                $data = ModelAnswer::where('test_id', $this->test->id)->get()->first();
            }
            $data->update($answer);
            session()->flash('answer', 'Successfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function maxAnswer(){
        return ModelAnswer::where('test_id', $this->test->id)->get();
    }
}
