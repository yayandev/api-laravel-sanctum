<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function Register(Request $request) {
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan!',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['email'] =  $user->email;
        $success['name'] =  $user->name;

        return response()->json([
            'status' => true,
            'message' => 'Registrasi Berhasil!',
            'data' => $success
        ]);
    }

    public function Login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth =Auth::user();
            $success['token'] =  $auth->createToken('auth_token')->plainTextToken;
            $success['name'] =  $auth->name;

            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil!',
                'data' => $success
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Email atau Password Anda Salah!',
                'data' => null
            ]);
        }
    }

    public function Logout(Request $request ) {

        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout Berhasil!',
        ]);
    }

    public function Unauthorized() {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized',
        ]);
    }
}
