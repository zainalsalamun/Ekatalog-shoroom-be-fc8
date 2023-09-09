<?php

namespace App\Http\Controllers\API;

use App\Models\Kondisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KondisiController extends Controller
{
    public function index()
    {
        $data = Kondisi::paginate(10);

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

        $kondisi = Kondisi::create([
            'nama'       => $request->nama,
            'stat'       => $request->stat,
        ]);

        if ($kondisi) {
            return response()->json([
                'success' => true,
                'message' => 'Kondisi Berhasil di Tambah',
            ]);
        }
    }

    public function edit(string $id)
    {
        $kondisi = Kondisi::find($id);

        if ($kondisi) {
            return response()->json([
                'success' => true,
                'message' => $kondisi,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kondisi Tidak Ditemukan',
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

        $kondisi = Kondisi::find($id);

        if (!$kondisi) {
            return response()->json([
                'success' => false,
                'message' => 'Kondisi Tidak Ditemukan',
            ]);
        }

        $kondisi->update([
            'nama'      => $request->nama,
            'stat'      => $request->stat,
        ]);

        if ($kondisi) {
            return response()->json([
                'success' => true,
                'message' => 'Kondisi Berhasil di Ubah',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $kondisi = Kondisi::find($id);

        if (!$kondisi) {
            return response()->json([
                'success' => false,
                'message' => 'Kondisi Tidak Ditemukan',
            ]);
        }

        $kondisi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kondisi Berhasil di Hapus',
        ]);
    }
}
