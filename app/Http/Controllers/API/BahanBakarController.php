<?php

namespace App\Http\Controllers\API;

use App\Models\BahanBakar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BahanBakarController extends Controller
{
    public function index()
    {
        $data = BahanBakar::paginate(10);

        return response()->json([
            'status' => true,
            'message' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $message = [
            'nama.required'       => 'Nama Harus di Isi',
            'stat.required'       => 'Status Harus di Isi',
        ];

        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'stat'      => 'required',
        ], $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $bahan_bakar = BahanBakar::create([
            'nama'       => $request->nama,
            'stat'       => $request->stat,
        ]);

        if ($bahan_bakar) {
            return response()->json([
                'success' => true,
                'message' => 'Bahan Bakar Berhasil di Tambah',
            ]);
        }
    }

    public function edit(string $id)
    {
        $bahan_bakar = BahanBakar::find($id);

        if ($bahan_bakar) {
            return response()->json([
                'success' => true,
                'message' => $bahan_bakar,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bahan Bakar Tidak Ditemukan',
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $message = [
            'nama.required'       => 'Nama Harus di Isi',
            'stat.required'       => 'Status Harus di Isi',
        ];

        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'stat'      => 'required',
        ], $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $bahan_bakar = BahanBakar::find($id);

        if (!$bahan_bakar) {
            return response()->json([
                'success' => false,
                'message' => 'Bahan Bakar Tidak Ditemukan',
            ]);
        }

        $bahan_bakar->update([
            'nama'      => $request->nama,
            'stat'      => $request->stat,
        ]);

        if ($bahan_bakar) {
            return response()->json([
                'success' => true,
                'message' => 'Bahan Bakar Berhasil di Ubah',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $bahan_bakar = BahanBakar::find($id);

        if (!$bahan_bakar) {
            return response()->json([
                'success' => false,
                'message' => 'Bahan Bakar Tidak Ditemukan',
            ]);
        }

        $bahan_bakar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bahan Bakar Berhasil di Hapus',
        ]);
    }
}
