<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $fillable = ['materi_id', 'type'];
    use HasFactory;
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
    public function pquestion()
    {
        return $this->hasMany(Pquestion::class);
    }
}
