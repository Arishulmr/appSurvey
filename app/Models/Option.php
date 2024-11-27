<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['pertanyaan_id', 'option_text'];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}