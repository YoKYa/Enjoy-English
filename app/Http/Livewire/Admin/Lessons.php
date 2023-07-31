<?php

namespace App\Http\Livewire\Admin;

use App\Models\Lesson;
use App\Models\Materi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithFileUploads};

class Lessons extends Component
{
    use WithFileUploads;
    public $materi;
    public $lessons;

    // Upload
    public $file;

    public function mount($slug){
        $this->materi = Materi::where('slug', $slug)->first();
        $this->loadLessons();
    }
    public function render()
    {
        return view('livewire.admin.lessons');
    }

    public function deleteFile() {
        $this->file = null;
    }
    public function updatedFile(){
        $this->validate([
            'file' => 'image|max:10240', 
        ]);
    }
    public function saveFile() {
        $path = $this->file->storeAs(
             'lessons', $this->materi->slug .'-'. Str::random(5).'.png'
        );
        $picture = [
            "materi_id"      =>  $this->materi->id,
            "picture"      =>  $path,
        ];
        Lesson::create($picture);
        $this->loadLessons();
        $this->deleteFile();
    }
    public function loadLessons(){
        $this->materi = Materi::where('slug', $this->materi->slug)->first();
        $this->lessons = $this->materi->lessons;
    }
    public function deletePicture(Lesson $id) {
        Storage::delete($id->picture);
        $id->forceDelete();
        $this->loadLessons();
    }
}
