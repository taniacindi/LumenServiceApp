<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return response()->json(Mahasiswa::all());
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => $request->input('nim'),
            'nama_mahasiswa' => $request->input('nama_mahasiswa'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'prodi_id' => $request->input('prodi_id')
        ]);

        return response()->json($mahasiswa, 201);
    }
}