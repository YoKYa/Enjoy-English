<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panswer extends Model
{
    use HasFactory;
    protected $fillable = ['practice_id', 'type', 'typeanswer','data', 'nomor', 'answer', 'data'];
    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }
}
