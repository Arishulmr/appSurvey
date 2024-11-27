<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $fillable = ['pertanyaan', 'tipe_pertanyaan', 'questionnaire_id'];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class, 'questionnaire_id');
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
