<?php

namespace App\Http\Controllers\API;

use App\Models\Showroom;
use App\Models\UserShowroom;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShowroomController extends Controller
{
    public function index(Request $request)
    {
    }

    public function store(Request $request)
    {

        $message = [
            'nama.required'      => 'Nama Harus di Isi',
            'alamat.required'    => 'Alamat Harus di Isi',
            'no_hp.required'     => 'No Handphone Harus di Isi',
            'no_hp.min'          => 'Username Minimal 10 Angka',
            'no_hp.max'          => 'Username Max 13 Angka',
            'username.required'  => 'Username Harus di Isi',
            'username.min'       => 'Username Minimal 5 Huruf',
            'username.unique'    => 'Username Sudah Terpakai',
            'logo.image'         => 'Logo Harus File Image',
            'logo.mimes'         => 'Logo Harus Format JPEG, JPG, PNG',
            'logo.max'           => 'Logo Maksimal 2 MB',
        ];

        $validator = Validator::make($request->all(), [
            'nama'       => 'required',
            'alamat'     => 'required',
            'logo'       => 'image|mimes:jpeg,png,jpg|max:2048',
            'no_hp'      => 'required|min:10|max:13',
            'username'   => 'required|min:5|unique:showroom',
        ], $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $default = 'upload/no_image.jpg';
        if ($request->has('logo')) {
            $image = $request->logo;
            $path = 'upload/showroom';
            $nameFile = $image->store($path, 'public');
        }

        $showroom = Showroom::create([
            'id_paket'         => '9a1ee4da-9bbf-4b59-a6d1-0abad7491087', // id_paket tipe free
            'nama'             => $request->nama,
            'no_hp'            => $request->no_hp,
            'username'         => $request->username,
            'alamat'           => $request->alamat,
            'logo'             => !empty($request->file('logo')) ? $nameFile : $default,
            'expired_showroom' => Carbon::now()->addMonth()->format('Y-m-d'),
            'stat'             => 1

        ]);

        UserShowroom::where('id_user', auth()->user()->id)->update([
            'id_showroom' => $showroom->id
        ]);

        if ($showroom) {
            return response()->json([
                'success' => true,
                'message' => 'Showroom Berhasil di Tambah',
            ]);
        }
    }

    public function edit(string $id)
    {
        $showroom = Showroom::find($id);

        if ($showroom) {
            return response()->json([
                'success' => true,
                'message' => $showroom,
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
            'nama.required'      => 'Nama Harus di Isi',
            'alamat.required'    => 'Alamat Harus di Isi',
            'no_hp.required'     => 'No Handphone Harus di Isi',
            'no_hp.min'          => 'Username Minimal 10 Angka',
            'no_hp.max'          => 'Username Max 13 Angka',
            'logo.image'         => 'Logo Harus File Image',
            'logo.mimes'         => 'Logo Harus Format JPEG, JPG, PNG',
            'logo.max'           => 'Logo Maksimal 2 MB',
        ];

        $rules = [
            'nama'       => 'required',
            'alamat'     => 'required',
            'no_hp'      => 'required|min:10|max:13',
        ];

        if ($request->hasFile('logo')) {
            $rules['logo'] = 'image|mimes:jpeg,png,jpg|max:2048';
        }

        $validator = Validator::make($request->all(), $rules, $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $showroom = Showroom::find($id);

        if (!$showroom) {
            return response()->json([
                'success' => false,
                'message' => 'Outlet Tidak Ditemukan',
            ]);
        }

        if ($request->has('logo')) {
            $image = $request->logo;
            $path = 'upload/showroom';
            $nameFile = $image->store($path, 'public');

            Storage::disk('public')->delete($showroom->logo);
        }

        $showroom->update([
            'id_paket'         => '9a1ee4da-9bbf-4b59-a6d1-0abad7491087',
            'nama'             => $request->nama,
            'no_hp'            => $request->no_hp,
            'alamat'           => $request->alamat,
            'logo'             => !empty($request->file('logo')) ? $nameFile : $showroom->logo,
            'expired_showroom' => Carbon::now()->addMonth()->format('Y-m-d'),
            'stat'             => 1

        ]);

        if ($showroom) {
            return response()->json([
                'success' => true,
                'message' => 'Showroom Berhasil di Ubah',
            ]);
        }
    }
}
