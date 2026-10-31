<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        return response()->json(Matakuliah::all());
    }

    public function store(Request $request)
    {
        $matakuliah = Matakuliah::create([
            'kode_mk' => $request->input('kode_mk'),
            'nama_mk' => $request->input('nama_mk'),
            'sks' => $request->input('sks'),
            'dosen_id' => $request->input('dosen_id')
        ]);

        return response()->json($matakuliah, 201);
    }
}