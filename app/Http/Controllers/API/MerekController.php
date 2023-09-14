<?php

namespace App\Http\Controllers\API;

use App\Models\Merek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MerekController extends Controller
{
    public function index()
    {
        $merek = Merek::paginate(10);

        return response()->json([
            'status' => true,
            'message' => $merek,
        ]);
    }

    public function store(Request $request)
    {
        $message = [
            'nama.required'      => 'Nama Harus di Isi',
            'image.required'     => 'Nama Harus di Isi',
            'image.image'        => 'Gambar Harus File Image',
            'image.mimes'        => 'Gambar Harus Format JPEG, JPG, PNG',
            'image.max'          => 'Gambar Maksimal 2 MB',
            'stat.required'      => 'Status Harus di Isi',
        ];

        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'stat'      => 'required',
        ], $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $image = $request->image;
        $path = 'upload/merek';
        $nameFile = $image->store($path, 'public');

        $merek = Merek::create([
            'nama'       => $request->nama,
            'image'      => $nameFile,
            'stat'       => $request->stat,
        ]);

        if ($merek) {
            return response()->json([
                'success' => true,
                'message' => 'Merek Berhasil di Tambah',
            ]);
        }
    }

    public function edit(string $id)
    {
        $merek = Merek::find($id);

        if ($merek) {
            return response()->json([
                'success' => true,
                'message' => $merek,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Merek Tidak Ditemukan',
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $message = [
            'nama.required'      => 'Nama Harus di Isi',
            'image.required'     => 'Nama Harus di Isi',
            'image.image'        => 'Gambar Harus File Image',
            'image.mimes'        => 'Gambar Harus Format JPEG, JPG, PNG',
            'image.max'          => 'Gambar Maksimal 2 MB',
            'stat.required'      => 'Status Harus di Isi',
        ];

        $rules = [
            'nama'     => 'required',
            'stat'     => 'required',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|max:2048';
        }

        $validator = Validator::make($request->all(), $rules, $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $merek = Merek::find($id);

        if (!$merek) {
            return response()->json([
                'success' => false,
                'message' => 'Merek Tidak Ditemukan',
            ]);
        }

        if ($request->has('image')) {
            $image = $request->image;
            $path = 'upload/merek';
            $nameFile = $image->store($path, 'public');

            Storage::disk('public')->delete($merek->image);
        }

        $merek->update([
            'nama'      => $request->nama,
            'image'     => !empty($request->file('image')) ? $nameFile : $merek->image,
            'stat'      => $request->stat,
        ]);

        if ($merek) {
            return response()->json([
                'success' => true,
                'message' => 'Merek Berhasil di Ubah',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $merek = Merek::find($id);

        if (!$merek) {
            return response()->json([
                'success' => false,
                'message' => 'Merek Tidak Ditemukan',
            ]);
        }

        $merek->delete();

        return response()->json([
            'success' => true,
            'message' => 'Merek Berhasil di Hapus',
        ]);
    }
}
