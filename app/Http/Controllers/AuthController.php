<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login (Request $req)
    {
        try {
            $this->validate($req, [
                'email' => 'required|email',
            ], [
                'email.required' => 'Bat buoc phai nhap gia tri',
                'email.email' => 'Sai dinh dang email'
            ]);

            $credentials = request(['email', 'password']);

            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return response()->json([
                'access_token' => $token,
                "error" => "fail",
                "message" => "Login success"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "true",
                "message" => $th->getMessage()
            ]);
        }
    }
}
