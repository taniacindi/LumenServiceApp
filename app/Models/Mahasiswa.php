<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'jenis_kelamin',
        'prodi_id'
    ];
}