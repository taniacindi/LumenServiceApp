<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        return response()->json(Prodi::all());
    }

    public function store(Request $request)
    {
        $prodi = Prodi::create([
            'nama_prodi' => $request->input('nama_prodi'),
            'jenjang' => $request->input('jenjang')
        ]);

        return response()->json($prodi, 201);
    }

    public function show($id)
    {
        $prodi = Prodi::find($id);

        if (!$prodi) {
            return response()->json(['pesan' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($prodi);
    }

    public function update(Request $request, $id)
    {
        $prodi = Prodi::find($id);

        if (!$prodi) {
            return response()->json(['pesan' => 'Data tidak ditemukan'], 404);
        }

        $prodi->update([
            'nama_prodi' => $request->input('nama_prodi'),
            'jenjang' => $request->input('jenjang')
        ]);

        return response()->json($prodi);
    }

    public function destroy($id)
    {
        $prodi = Prodi::find($id);

        if (!$prodi) {
            return response()->json(['pesan' => 'Data tidak ditemukan'], 404);
        }

        $prodi->delete();

        return response()->json(['pesan' => 'Data berhasil dihapus']);
    }
}