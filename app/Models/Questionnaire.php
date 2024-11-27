<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kategori_id'];

    public function kategori()
{
    return $this->belongsTo(KategoriSurvey::class, 'kategori_id');
}
public function pertanyaan()
{
    return $this->hasMany(Pertanyaan::class, 'questionnaire_id');
}

}