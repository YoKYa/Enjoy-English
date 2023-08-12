<?php

namespace App\Http\Livewire;

use App\Models\Score;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View\Components\Alert;
use App\Models\{Answer, Materi, Question, Test};

class Tests extends Component
{
    public $materi, $tests, $answers, $randomAnswers, $correct = [], $score;
    public $test;
    public $no = 0, $maxLine, $end = false;

    // Type 1
    public $a, $b;
    public $answerType = [0,0,0,0];
    public $jawaban = [false, false, false, false];
    // Type 2 Dan 3
    public $answerType2 = [];
    // Type 4
    public $writeAnswer;
    public function mount($slug){    
        $this->materi = Materi::where('slug', $slug)->first();
        $this->tests = Test::where('materi_id', $this->materi->id)->get();
        $this->getTest();
        $this->getAnswers();
        if ($this->checkTypeAnswer() == 2 || $this->checkTypeAnswer() == 3) {
            $this->getRandom($this->answers);
        }
    }
    public function render(){
        return view('livewire.tests')->layout('layouts.app-materi');
    }
    // Get Data from Database
    public function getTest(){
        $this->test = Test::find($this->tests[$this->no]->id); 
        $this->maxLine = Question::where('test_id', $this->test->id)->max('line');
    }
    public function getAnswers(){
        $this->answers = Answer::where('test_id', $this->test->id)->get();
    }
    public function getRandom($data){
        $this->randomAnswers = $data->shuffle()->all();
    }
    public function getQuestionLine($line) {
        return Question::where('test_id', $this->test->id)->where('line', $line)->get();
    }
    public function getAnswer($no){
        return Answer::where('test_id', $this->test->id)->where('nomor', $no)->get();
    }
    // Check
    public $uwu;
    public function checkTypeAnswer(){
        return Answer::where('test_id', $this->test->id)->first()->type;
    }
    public function checkAnswer(){
        $correct = true;
        if ($this->checkTypeAnswer() == 1) {
            $answer = array_map('intval', explode(",", $this->getAnswer(1)->first()->answer));
            for ($i=0; $i < 4; $i++) {
                if ($answer[$i] == $this->answerType[$i]) {
                    $this->jawaban[$i] = true;            
                }else{
                    $correct = false;
                }
            }
        }
        elseif($this->checkTypeAnswer() == 2) {
            for ($i=0; $i < count($this->answers); $i++) {
                if (count($this->answerType2) == 0) {
                    $correct = false;
                }else{
                    if (count($this->answerType2) != count($this->answers)){
                        $correct = false;
                    }elseif ($this->answers[$i]['nomor'] != $this->answerType2[$i]['nomor'] ) {
                        $correct = false;
                    }
                }
            }
        }elseif($this->checkTypeAnswer() == 3 ){
            if (count($this->answerType2) == 0) {
               $correct = false;
            }else{
                if ($this->answerType2[0]['nomor'] != $this->getAnswer(1)[0]->nomor ) {
                    $correct = false;
                }
            }
        }elseif($this->checkTypeAnswer() == 4 ){
            if ($this->writeAnswer == '' ) {
                $correct = false;
            }else{
                if (\strtoupper($this->writeAnswer) != $this->getAnswer(1)[0]->answer) {
                     $correct = false;
                }
            }
        }
       $this->correct[] = $correct; 
    }
    // Choice
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
        }else{
           dd('error, Please Reload Browser');
        }
    }
    public function deleteChoiceAnswer($i){
        $data = null;
        $data= $this->answerType2[$i];
        array_splice($this->answerType2, $i, 1);
        $this->randomAnswers[] = $data;
    }
    public function next(){
        $this->checkAnswer();
        if (count($this->tests) == $this->no+1) {
            $question = count($this->correct);
            $count = 0;
            foreach ($this->correct as $correct) {
                if ($correct == true) {
                    $count++;
                }
            }
            $count = $count/$question;
            $this->insertScore(number_format((float)$count, 2, '.', ''));
            $this->end = true;
        }else{
            $this->no++;
            $this->getTest();
            $this->getAnswers();
            $this->answerType2 = [];
            $this->answerType = [0,0,0,0];
            $this->jawaban = [false, false, false, false];
            $this->a = null; 
            $this->b = null;
            if ($this->checkTypeAnswer() == 2 || $this->checkTypeAnswer() == 3) {
                $this->getRandom($this->answers);
            }
        }
    }
    public function insertScore($score) {
        $this->score = Score::create(['user_id' => \auth()->user()->id, 'materi_id' => $this->materi->id, 'score' => $score*100 ]);
    }
}
