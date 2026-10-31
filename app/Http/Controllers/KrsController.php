<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        return response()->json(Krs::all());
    }

    public function store(Request $request)
    {
        $krs = Krs::create([
            'mahasiswa_id' => $request->input('mahasiswa_id'),
            'matakuliah_id' => $request->input('matakuliah_id'),
            'semester' => $request->input('semester'),
            'tahun_ajaran' => $request->input('tahun_ajaran')
        ]);

        return response()->json($krs, 201);
    }
}