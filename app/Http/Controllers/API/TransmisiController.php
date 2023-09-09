<?php

namespace App\Http\Controllers\API;

use App\Models\Transmisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransmisiController extends Controller
{
    public function index()
    {
        $data = Transmisi::paginate(10);

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

        $transmisi = Transmisi::create([
            'nama'       => $request->nama,
            'stat'       => $request->stat,
        ]);

        if ($transmisi) {
            return response()->json([
                'success' => true,
                'message' => 'Transmisi Berhasil di Tambah',
            ]);
        }
    }

    public function edit(string $id)
    {
        $transmisi = Transmisi::find($id);

        if ($transmisi) {
            return response()->json([
                'success' => true,
                'message' => $transmisi,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Transmisi Tidak Ditemukan',
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

        $transmisi = Transmisi::find($id);

        if (!$transmisi) {
            return response()->json([
                'success' => false,
                'message' => 'Transmisi Tidak Ditemukan',
            ]);
        }

        $transmisi->update([
            'nama'      => $request->nama,
            'stat'      => $request->stat,
        ]);

        if ($transmisi) {
            return response()->json([
                'success' => true,
                'message' => 'Transmisi Berhasil di Ubah',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $transmisi = Transmisi::find($id);

        if (!$transmisi) {
            return response()->json([
                'success' => false,
                'message' => 'Transmisi Tidak Ditemukan',
            ]);
        }

        $transmisi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transmisi Berhasil di Hapus',
        ]);
    }
}
