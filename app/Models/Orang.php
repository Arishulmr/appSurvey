<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orang extends Model
{
    use HasFactory;


    protected $table = 'orang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'nomor_telepon',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}