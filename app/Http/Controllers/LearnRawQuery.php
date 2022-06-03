<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class LearnRawQuery extends Controller
{
    public function getAll() {

        // $data = DB::select('SELECT * FROM learnRawQuery WHERE id = ?', [2]);
        $data = DB::select('SELECT * FROM learnRawQuery');

        return response()->json([
            "data" => $data
        ]);
    }

    public function getById($id) {
        $data = DB::select('SELECT * FROM learnRawQuery WHERE id = ?', [$id]);

        return response()->json([
            "data" => $data
        ]);
    }

    public function delete($id) {

        try {
            DB::select('DELETE FROM learnRawQuery WHERE id = ?', [$id]);

            return response()->json([
                "error" => "true",
                "status" => "fail",
                "message" => "deleted"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => "true",
                "status" => "fail",
                "message" => $th->getMessage()
            ]);
        }
    }

    public function add(Request $req) {
        try {
            $this->validate($req, [
                'fullname' => 'required|min:6',
                'email' => 'required|email'
            ], [
                'fullname.required' => 'Bat buoc phai nhap ho ten',
                'fullname.min' => 'Ho ten phai tu :min ky tu tro len',
                'email.required' => 'Bat buoc phai nhap email',
                'email.email' => 'Khong dung dinh dang email'
            ]);

            $data = [
                $req->fullname,
                $req->email
            ];


            DB::insert('INSERT INTO learnRawQuery (fullname, email) VALUE (?, ?)', $data);
            return response()->json([
                "error" => "false",
                "status" => "success",
                "message" => "created"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "true",
                "status" => "fail",
                "message" => $th->getMessage()
            ]);
        }
    }

    public function update(Request $req, $id) {
        try {
            $this->validate($req, [
                'fullname' => 'required|min:6',
                'email' => 'required|email'
            ], [
                'fullname.required' => 'Bat buoc phai nhap ho ten',
                'fullname.min' => 'Ho ten phai tu :min ky tu tro len',
                'email.required' => 'Bat buoc phai nhap email',
                'email.email' => 'Khong dung dinh dang email'
            ]);

            $data = [
                $req->fullname,
                $req->email
            ];

            $data[] = $id;


            DB::update('UPDATE learnRawQuery SET fullname=?, email=? WHERE id=?', $data);
            return response()->json([
                "error" => "false",
                "status" => "success",
                "message" => "updated",
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "true",
                "status" => "fail",
                "message" => $th->getMessage()
            ]);
        }
    }
}
