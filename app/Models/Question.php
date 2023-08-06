<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['test_id', 'type', 'line','data'];
    use HasFactory;
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
