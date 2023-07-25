<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Topic, Materi as ModelsMateri};
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class Materi extends Component
{
    public $topic;
    public $materis;
    public $materi;

    public $title;
    public $description;
    public $order = 0;

    public $addMateriModal = false;
    public $editMateriModal = false;
    public $deleteMateriModal = false;
    public function mount(Topic $id) 
    {
        $this->topic = $id;
        $this->materis = ModelsMateri::where('topic_id', $this->topic->id)->orderBy('order', 'Asc')->get();
        $this->order = $id->materis->count()+1;
    }
    public function render()
    {
        return view('livewire.admin.materi');
    }
    public function modalMateri($type){
        if ($type == 'add') {
            $this->addMateriModal = !$this->addMateriModal;
        }else if($type == 'edit'){
            $this->editMateriModal = !$this->editMateriModal;
        }else if($type =='delete') {
           $this->deleteMateriModal = !$this->deleteMateriModal;
        }else{
            dd("Invalid Modal Type");
        }
        
    }
    // Add
    public function addMateri(){
        $this->title = '';
        $this->order = $this->materis->count()+1;
        $this->modalMateri('add');
    }
    public function confirmAddMateri(){
        $materi = [
            "title"      =>  $this->title,
            "slug"      =>  Str::slug($this->title),
            "description"      =>  $this->description,
            "topic_id"  => $this->topic->id,
            "order"     =>   $this->order,
        ];
       Validator::make($materi, [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['string', 'max:255'],
            'description' => ['required','string'],
            'topic_id' => ['required'],
            'order' => ['numeric'],
        ])->validateWithBag('createMateri');
        ModelsMateri::create($materi);
        session()->flash('message', 'Materi Added Successfully');
        $this->resetErrorBag();
        $this->loadMateri('add');
    }
    public function loadMateri($type) {
        if ($type == 'edit') {
            $this->modalMateri('edit');
        }else if ($type == 'add') {
            $this->modalMateri('add');
            $this->order++;
        }else if($type == 'delete'){
            $this->modalMateri('delete');
        }
        $this->materis = ModelsMateri::where('topic_id', $this->topic->id)->orderBy('order', 'Asc')->get();
    }

    // Edit 
    public function editMateri($id){
        $this->materi = ModelsMateri::find($id);
        $this->title = $this->materi->title;
        $this->description = $this->materi->description;
        $this->order = $this->materi->order;
        $this->modalMateri('edit');
    }
    public function confirmEditMateri(){
        $materi = [
            "title"      =>  $this->title,
            "order"     =>   $this->order,
            "description" => $this->description
        ];
        $update = Validator::make($materi, [
            'title' => ['required', 'string', 'max:255'],
            'order' => ['numeric'],
            'description' => ['required','string'],
        ])->validateWithBag('editMateri');
        $this->materi->forceFill($update)->save();
        session()->flash('message', 'Materi Update Successfully');
        $this->resetErrorBag();
        $this->loadMateri('edit');
    }

    // Delete
    public function deleteMateri($id){
        $this->materi = ModelsMateri::find($id);
        $this->title =  $this->materi->title;
        $this->modalMateri('delete');
    }
    public function confirmDeleteMateri(){
        $this->materi->delete();
        session()->flash('message', 'Materi Delete Successfully');
        $this->loadMateri('delete');
    }
}
