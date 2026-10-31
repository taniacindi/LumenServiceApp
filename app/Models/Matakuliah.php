<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliahs';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'dosen_id'
    ];
}