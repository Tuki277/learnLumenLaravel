<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getAllCategory()
    {
        try {
            return response() -> json([
                "error" => "false",
                "count" => Category::all()->count(),
                "data" => Category::all(),
            ]);
        } catch (\Throwable $th) {
            return response() -> json([
                "error" => "true",
                "data" => $th->getMessage()
            ]);
        }
    }

    public function postCategory(Request $req)
    {
        try {

            $this->validate($req, [
                "title" => "required"
            ], [
                'required' => "Bat buoc phai nhap tieu de"
            ]);

            $post = new Category();
            $post->title = $req->title;

            if ($post->save())
            {
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

    public function updateCategory(Request $req, $id) {
        try {
            $post = Category::find($id);
            $post->title = $req->title;

            if ($post->save())
            {
                return response()->json([
                    "error" => "false",
                    "status" => "success",
                    "message" => "updated"
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

    public function deleteCategory($id) {
        try {
            $post = Category::find($id);

            if ($post->delete()) {
                return response()->json([
                    "error" => "false",
                    "status" => "success",
                    "message" => "Deleted"
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

    public function getById ($id) {
        try {
            return response()->json([
                "error" => "false",
                "data" => Category::find($id)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => "false",
                "data" => $th->getMessage()
            ]);
        }
    }
}
