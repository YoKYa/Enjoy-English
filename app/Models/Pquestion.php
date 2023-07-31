<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pquestion extends Model
{
    protected $fillable = ['practice_id', 'type', 'line','data'];
    use HasFactory;
    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }
}
