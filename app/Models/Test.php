<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = ['materi_id'];
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
     public function question()
    {
        return $this->hasMany(Question::class);
    }
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
}
