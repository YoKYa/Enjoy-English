<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $fillable = ['title','publish', 'order', 'topic_id','slug', 'description'];
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function practices()
    {
        return $this->hasMany(Practice::class);
    }
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
