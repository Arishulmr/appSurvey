<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orang_id',
        'masukan_id',
        'jawaban',
        'selesai_pada',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'selesai_pada' => 'datetime',
    ];

    /**
     * Get the person associated with the answer.
     */
    public function orang()
    {
        return $this->belongsTo(Orang::class, 'orang_id');
    }

    /**
     * Get the input associated with the answer.
     */
    public function masukan()
    {
        return $this->belongsTo(Masukan::class, 'masukan_id');
    }
}