<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSurvey extends Model
{
    use HasFactory;

    protected $table = 'kategori_survey';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kategori_id',
        'nama_kategori',
        'deskripsi',
    ];

    public function questionnaires(){
    return $this->hasMany(Questionnaire::class, 'kategori_id');

    }
}