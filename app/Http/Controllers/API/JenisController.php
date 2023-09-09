<?php

namespace App\Http\Controllers\API;

use App\Models\Jenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JenisController extends Controller
{

    public function index()
    {
        $data = Jenis::paginate(10);

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

        $jenis = Jenis::create([
            'nama'       => $request->nama,
            'stat'       => $request->stat,
        ]);

        if ($jenis) {
            return response()->json([
                'success' => true,
                'message' => 'Jenis Berhasil di Tambah',
            ]);
        }
    }

    public function edit(string $id)
    {
        $jenis = Jenis::find($id);

        if ($jenis) {
            return response()->json([
                'success' => true,
                'message' => $jenis,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Jenis Tidak Ditemukan',
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

        $jenis = Jenis::find($id);

        if (!$jenis) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis Tidak Ditemukan',
            ]);
        }

        $jenis->update([
            'nama'      => $request->nama,
            'stat'      => $request->stat,
        ]);

        if ($jenis) {
            return response()->json([
                'success' => true,
                'message' => 'Jenis Berhasil di Ubah',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $jenis = Jenis::find($id);

        if (!$jenis) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis Tidak Ditemukan',
            ]);
        }

        $jenis->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jenis Berhasil di Hapus',
        ]);
    }
}
