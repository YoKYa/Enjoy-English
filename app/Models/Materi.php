<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'order', 'topic_id','slug', 'description'];
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
