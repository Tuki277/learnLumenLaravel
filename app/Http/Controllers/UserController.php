<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Register (Request $req) {
        try {

            $this->validate($req, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ], [
                'name.required' => 'Bat buoc phai nhap ten',
                'email.required' => 'Bat buoc phai nhap email',
                'email.email' => 'Dinh dang email khong dung',
                'password.required' => 'Bat buoc phai nhap password',
                'password.min' => 'Chieu dai it nhat la 6 ky tu'
            ]);

            $user = new User();

            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = app('hash')->make($req->password);

            if ($user->save()) {
                return response()->json([
                    "error" => "false",
                    "status" => "success",
                    "message" => "created"
                ]);
            }

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "true",
                "status" => "fail",
                "message" => $th->getMessage()
            ]);
        }
    }
}
