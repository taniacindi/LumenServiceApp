<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        return response()->json(Dosen::all());
    }

    public function store(Request $request)
    {
        $dosen = Dosen::create([
            'nidn' => $request->input('nidn'),
            'nama_dosen' => $request->input('nama_dosen'),
            'email' => $request->input('email')
        ]);

        return response()->json($dosen, 201);
    }
}