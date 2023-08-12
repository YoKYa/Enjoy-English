<?php

namespace App\Http\Livewire;

use App\Models\{Materi, Panswer, Pquestion, Practice};
use Livewire\Component;

class Practices extends Component
{
    public $materi, $practices,$answers;
    public $practice;
    public $no = 0, $maxLine, $listening = false, $end = false;
    public $checkAnswerModal = false;

    // Type 1
    public $a, $b;
    public $answerType = [0,0,0,0];
    public $jawaban = [false, false, false, false];
    // Type 2
    public $answerType2 = []; // + 3
    public $randomAnswers;
    // Type 4
    public $writeAnswer;
    public function mount($slug){    
        $this->materi = Materi::where('slug', $slug)->first();
        $this->practices = Practice::where('materi_id', $this->materi->id)->get('id', 'type');
        $this->getPractice();
        $this->getAnswers();
        if ($this->checkTypeAnswer() == 2 || $this->checkTypeAnswer() == 3) {
            $this->getRandom($this->answers);
        }
    }
    public function render(){
        return view('livewire.practices')->layout('layouts.app-materi');
    }
    public function getPractice() {
        $this->practice = Practice::find($this->practices[$this->no]->id); 
        $this->maxLine = Pquestion::where('practice_id', $this->practice->id)->max('line');
    }
    public function getQuestionLine($line) {
        return Pquestion::where('practice_id', $this->practice->id)->where('line', $line)->get();
    }
    public function next(){
        
        if (count($this->practices) == $this->no+1) {
            $this->end = true;
        }else{
            $this->no++;
            $this->getPractice();
            $this->getAnswers();
            $this->answerType = [0,0,0,0];
            $this->jawaban = [false, false, false, false];
            $this->a = null; 
            $this->b = null;
            $this->answerType2 = [];
            if ($this->checkTypeAnswer() == 2 || $this->checkTypeAnswer() == 3) {
                $this->getRandom($this->answers);
            }
        }
    }
    // Listening
    public function startListening() {
        $this->listening = true;
    }
    public function stopListening() {
        $this->listening = false;
    }
    // Grammar
    public function getAnswers(){
        $this->answers = Panswer::where('practice_id', $this->practice->id)->get();
    }
    public function checkTypeAnswer(){
        return Panswer::where('practice_id', $this->practice->id)->first()->type;
    }
    public function getAnswer($no){
        return Panswer::where('practice_id', $this->practice->id)->where('nomor', $no)->get();
    }
    public function checkAnswer(){
        if ($this->checkTypeAnswer() == 1) {
            $answer = array_map('intval', explode(",", $this->getAnswer(1)->first()->answer));
            for ($i=0; $i < 4; $i++) {
                if ($answer[$i] == $this->answerType[$i]) {
                    $this->jawaban[$i] = true;            
                }
            }
        }
        $this->checkAnswerModal = true;
    }
    public function modal(){
        $this->checkAnswerModal = false;
    }
    public function choiceAnswer($no){
        if ($no <=4) {
            if ($this->a == $no) {
                $this->a = null;
            }else{
                $this->a = $no;     
            }
        }else{
            if ($this->b == $no) {
                $this->b = null;
            }else{
                if ($this->a != null) {
                    $this->b = $no; 
                    $this->answerType[$this->b-5] = $this->a;
                }
            }
        }
    }

    public function choiceAnswer2($i){
        $data= $this->randomAnswers[$i];
        if ($this->checkTypeAnswer() == 2) {
            array_splice($this->randomAnswers, $i, 1);
            $this->answerType2[] = $data;
        }elseif($this->checkTypeAnswer() == 3 ){
            if (count($this->answerType2) < 1) {
                $this->answerType2[] = $data;
                array_splice($this->randomAnswers, $i, 1);
            }else{
                $temp =  $this->answerType2[0];
                $this->answerType2[0] = $data;
                $this->randomAnswers[$i] = $temp;
            }
        }
    }
    public function deleteChoiceAnswer($i){
        $data = null;
        if ($this->checkTypeAnswer() == 2) {
            $data= $this->answerType2[$i];
            array_splice($this->answerType2, $i, 1);
        }elseif($this->checkTypeAnswer() == 3 ){
            $data= $this->answerType3[$i];
            array_splice($this->answerType3, $i, 1);
        }
        $this->randomAnswers[] = $data;
    }
    public function getRandom($data){
        $this->randomAnswers = $data->shuffle()->all();
    }
}
