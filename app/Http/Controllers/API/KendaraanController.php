<?php

namespace App\Http\Controllers\API;

use App\Models\Kendaraan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImageKendaraan;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $message = [
            'id_showroom.required'             => 'Id Showroom Harus di Isi',
            'id_jenis.required'                => 'Id Jenis Harus di Isi',
            'id_kondisi.required'              => 'Id Kondisi Harus di Isi',
            'id_merek.required'                => 'Id Merek Harus di Isi',
            'id_transmisi.required'            => 'Id Transmisi Harus di Isi',
            'id_tipe_bodi.required'            => 'Id Tipe Bodi Harus di Isi',
            'id_warna.required'                => 'Id Warna Harus di Isi',
            'id_bahan_bakar.required'          => 'Id Warna Harus di Isi',
            'id_tipe_roda_penggerak.required'  => 'Id TIpe Roda Penggerak Harus di Isi',
            'nama.required'                    => 'Nama Harus di Isi',
            'penumpang.required'               => 'Penumpang Harus di Isi',
            'pintu.required'                   => 'Pintu Harus di Isi',
            'km.required'                      => 'Km Harus di Isi',
            'tahun.required'                   => 'Tahun Harus di Isi',
            'harga.required'                   => 'Harga Harus di Isi',
        ];

        $validator = Validator::make($request->all(), [
            'id_showroom'             => 'required',
            'id_jenis'                => 'required',
            'id_kondisi'              => 'required',
            'id_merek'                => 'required',
            'id_transmisi'            => 'required',
            'id_tipe_bodi'            => 'required',
            'id_warna'                => 'required',
            'id_bahan_bakar'          => 'required',
            'id_tipe_roda_penggerak'  => 'required',
            'nama'                    => 'required',
            'penumpang'               => 'required',
            'pintu'                   => 'required',
            'km'                      => 'required',
            'tahun'                   => 'required',
            'harga'                   => 'required',
        ], $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $kendaraan = Kendaraan::create([
            'id_user'                 => auth()->user()->id,
            'id_showroom'             => $request->id_showroom,
            'id_jenis'                => $request->id_jenis,
            'id_kondisi'              => $request->id_kondisi,
            'id_merek'                => $request->id_merek,
            'id_transmisi'            => $request->id_transmisi,
            'id_tipe_bodi'            => $request->id_tipe_bodi,
            'id_warna'                => $request->id_warna,
            'id_bahan_bakar'          => $request->id_bahan_bakar,
            'id_tipe_roda_penggerak'  => $request->id_tipe_roda_penggerak,
            'nama'                    => $request->nama,
            'slug'                    => Str::slug($request->nama),
            'penumpang'               => $request->penumpang,
            'pintu'                   => $request->pintu,
            'km'                      => $request->km,
            'tahun'                   => $request->tahun,
            'harga'                   => $request->harga,
            'stat'                    => 1,
        ]);

        if ($request->has('image')) {
            $images = $request->image;
            foreach ($images as $image) {
                $path = 'upload/kendaraan';
                $nameFile = $image->store($path, 'public');

                ImageKendaraan::create([
                    'id_kendaraan' => $kendaraan->id,
                    'image'        => $nameFile,
                    'cover'        => 1
                ]);
            }
        }

        if ($kendaraan) {
            return response()->json([
                'success' => true,
                'message' => 'Kendaraaan Berhasil di Tambah',
            ]);
        }
    }

    public function edit(string $id)
    {
        $kendaraan = Kendaraan::with(['images'])->find($id);

        if ($kendaraan) {
            return response()->json([
                'success' => true,
                'message' => $kendaraan,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Showroom Tidak Ditemukan',
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $message = [
            'id_showroom.required'             => 'Id Showroom Harus di Isi',
            'id_jenis.required'                => 'Id Jenis Harus di Isi',
            'id_kondisi.required'              => 'Id Kondisi Harus di Isi',
            'id_merek.required'                => 'Id Merek Harus di Isi',
            'id_transmisi.required'            => 'Id Transmisi Harus di Isi',
            'id_tipe_bodi.required'            => 'Id Tipe Bodi Harus di Isi',
            'id_warna.required'                => 'Id Warna Harus di Isi',
            'id_bahan_bakar.required'          => 'Id Warna Harus di Isi',
            'id_tipe_roda_penggerak.required'  => 'Id TIpe Roda Penggerak Harus di Isi',
            'nama.required'                    => 'Nama Harus di Isi',
            'penumpang.required'               => 'Penumpang Harus di Isi',
            'pintu.required'                   => 'Pintu Harus di Isi',
            'km.required'                      => 'Km Harus di Isi',
            'tahun.required'                   => 'Tahun Harus di Isi',
            'harga.required'                   => 'Harga Harus di Isi',
        ];

        $validator = Validator::make($request->all(), [
            'id_showroom'             => 'required',
            'id_jenis'                => 'required',
            'id_kondisi'              => 'required',
            'id_merek'                => 'required',
            'id_transmisi'            => 'required',
            'id_tipe_bodi'            => 'required',
            'id_warna'                => 'required',
            'id_bahan_bakar'          => 'required',
            'id_tipe_roda_penggerak'  => 'required',
            'nama'                    => 'required',
            'penumpang'               => 'required',
            'pintu'                   => 'required',
            'km'                      => 'required',
            'tahun'                   => 'required',
            'harga'                   => 'required',
        ], $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Kendaraan Tidak Ditemukan',
            ]);
        }

        $kendaraan->update([
            'id_user'                 => auth()->user()->id,
            'id_showroom'             => $request->id_showroom,
            'id_jenis'                => $request->id_jenis,
            'id_kondisi'              => $request->id_kondisi,
            'id_merek'                => $request->id_merek,
            'id_transmisi'            => $request->id_transmisi,
            'id_tipe_bodi'            => $request->id_tipe_bodi,
            'id_warna'                => $request->id_warna,
            'id_bahan_bakar'          => $request->id_bahan_bakar,
            'id_tipe_roda_penggerak'  => $request->id_tipe_roda_penggerak,
            'nama'                    => $request->nama,
            'slug'                    => Str::slug($request->nama),
            'penumpang'               => $request->penumpang,
            'pintu'                   => $request->pintu,
            'km'                      => $request->km,
            'tahun'                   => $request->tahun,
            'harga'                   => $request->harga,
            'stat'                    => 1,
        ]);

        if ($request->has('image')) {
            $images = $request->image;
            foreach ($images as $image) {
                $path = 'upload/kendaraan';
                $nameFile = $image->store($path, 'public');

                ImageKendaraan::create([
                    'id_kendaraan' => $kendaraan->id,
                    'image'        => $nameFile,
                    'cover'        => 1
                ]);
            }
        }

        if ($kendaraan) {
            return response()->json([
                'success' => true,
                'message' => 'Kendaraaan Berhasil di Ubah',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Kendaraan Tidak Ditemukan',
            ]);
        }

        $kendaraan->images()->delete();
        $kendaraan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan Berhasil di Hapus',
        ]);
    }

    public function destroy_image(string $id)
    {
        $image_kendaraan = ImageKendaraan::find($id);

        if (!$image_kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Gambar Kendaraan Tidak Ditemukan',
            ]);
        }

        $image_kendaraan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gambar Kendaraan Berhasil di Hapus',
        ]);
    }
}
