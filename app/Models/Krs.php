<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'mahasiswa_id',
        'matakuliah_id',
        'semester',
        'tahun_ajaran'
    ];
}