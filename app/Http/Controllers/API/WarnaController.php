<?php

namespace App\Http\Controllers\API;

use App\Models\Warna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WarnaController extends Controller
{
    public function index()
    {
        $data = Warna::paginate(10);

        return response()->json([
            'status' => true,
            'message' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $message = [
            'nama.required'       => 'Nama Harus di Isi',
            'kode_warna.required' => 'Kode Warna Harus di Isi',
            'stat.required'       => 'Status Harus di Isi',
        ];

        $validator = Validator::make($request->all(), [
            'nama'       => 'required',
            'kode_warna' => 'required',
            'stat'       => 'required',
        ], $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $warna = Warna::create([
            'nama'        => $request->nama,
            'kode_warna'  => $request->kode_warna,
            'stat'        => $request->stat,
        ]);

        if ($warna) {
            return response()->json([
                'success' => true,
                'message' => 'Warna Berhasil di Tambah',
            ]);
        }
    }

    public function edit(string $id)
    {
        $warna = Warna::find($id);

        if ($warna) {
            return response()->json([
                'success' => true,
                'message' => $warna,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Warna Tidak Ditemukan',
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $message = [
            'nama.required'       => 'Nama Harus di Isi',
            'kode_warna.required' => 'Kode Warna Harus di Isi',
            'stat.required'       => 'Status Harus di Isi',
        ];

        $validator = Validator::make($request->all(), [
            'nama'          => 'required',
            'kode_warna'    => 'required',
            'stat'          => 'required',
        ], $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $warna = Warna::find($id);

        if (!$warna) {
            return response()->json([
                'success' => false,
                'message' => 'Warna Tidak Ditemukan',
            ]);
        }

        $warna->update([
            'nama'       => $request->nama,
            'kode_warna' => $request->kode_warna,
            'stat'       => $request->stat,
        ]);

        if ($warna) {
            return response()->json([
                'success' => true,
                'message' => 'Warna Berhasil di Ubah',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $warna = Warna::find($id);

        if (!$warna) {
            return response()->json([
                'success' => false,
                'message' => 'Warna Tidak Ditemukan',
            ]);
        }

        $warna->delete();

        return response()->json([
            'success' => true,
            'message' => 'Warna Berhasil di Hapus',
        ]);
    }
}
