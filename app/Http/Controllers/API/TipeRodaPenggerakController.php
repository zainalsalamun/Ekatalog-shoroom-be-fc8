<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\TipeRodaPenggerak;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TipeRodaPenggerakController extends Controller
{
    public function index()
    {
        $data = TipeRodaPenggerak::paginate(10);

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

        $tipe_roda_penggerak = TipeRodaPenggerak::create([
            'nama'       => $request->nama,
            'stat'       => $request->stat,
        ]);

        if ($tipe_roda_penggerak) {
            return response()->json([
                'success' => true,
                'message' => 'Tipe Roda Penggerak Berhasil di Tambah',
            ]);
        }
    }

    public function edit(string $id)
    {
        $tipe_roda_penggerak = TipeRodaPenggerak::find($id);

        if ($tipe_roda_penggerak) {
            return response()->json([
                'success' => true,
                'message' => $tipe_roda_penggerak,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tipe Roda Penggerak Tidak Ditemukan',
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

        $tipe_roda_penggerak = TipeRodaPenggerak::find($id);

        if (!$tipe_roda_penggerak) {
            return response()->json([
                'success' => false,
                'message' => 'Tipe Roda Penggerak Tidak Ditemukan',
            ]);
        }

        $tipe_roda_penggerak->update([
            'nama'      => $request->nama,
            'stat'      => $request->stat,
        ]);

        if ($tipe_roda_penggerak) {
            return response()->json([
                'success' => true,
                'message' => 'Tipe Roda Penggerak Berhasil di Ubah',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $tipe_roda_penggerak = TipeRodaPenggerak::find($id);

        if (!$tipe_roda_penggerak) {
            return response()->json([
                'success' => false,
                'message' => 'Tipe Roda Penggerak Tidak Ditemukan',
            ]);
        }

        $tipe_roda_penggerak->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tipe Roda Penggerak Berhasil di Hapus',
        ]);
    }
}
