<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PenggunaShowroom;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function user(Request $request)
    {
        $user = auth()->user()->load('showrooms');

        return response()->json([
            'status'  => true,
            'message' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $message = [
            'email.required'    => 'Email Harus di Isi',
            'password.required' => 'Password Harus di Isi',
        ];

        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ], $message);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email yang Anda masukan salah !'
            ], 422);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password yang Anda masukan salah !'
            ], 422);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'status'  => true,
            'message' => $user,
            'token'   => $token,
        ]);
    }

    public function register(Request $request)
    {
        $message = [
            'name.required'         => 'Nama Harus di Isi',
            'email.required'        => 'Email Harus di Isi',
            'email.unique'          => 'Email Sudah Terpakai',
            'password.required'     => 'Password Harus di Isi',
            'password.min'          => 'Password Minimal 8',
        ];

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:8'
        ], $message);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $id_role_owner = '9a1572e2-b888-44d7-b591-6b94a24c3873';
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'stat'     => 1,
        ]);

        $user->roles()->attach($id_role_owner, ['stat' => 1]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => $user,
            'token'   => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout Sukses',
        ]);
    }
}
