<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['picture', 'materi_id'];
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
