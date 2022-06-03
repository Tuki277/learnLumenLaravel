<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPost()
    {
        try {
            return response() -> json([
                "error" => "False",
                "count" => Post::all()->count(),
                "data" => Post::all(),
            ]);
        } catch (\Throwable $th) {
            return response() -> json([
                "error" => "True",
                "data" => $th->getMessage()
            ]);
        }
    }

    public function postPosts(Request $req)
    {
        try {

            // $this->validate($req, [
            //     'title' => "required"
            // ]);

            // ==============================

            // $rules = [
            //     'title' => 'required'
            // ];

            // $message = [
            //     'required' => 'Bat buoc phai nhap gia tri'
            // ];

            // $this->validate($req, $rules, $message);

            // ========================================

            $post = new Post();
            $post->title = $req->title;
            $post->body = $req->body;

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

    public function updatePosts(Request $req, $id) {
        try {
            $post = Post::find($id);
            $post->title = $req->title;
            $post->body = $req->body;

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

    public function deletePosts($id) {
        try {
            $post = Post::find($id);

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
                "data" => Post::find($id)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => "false",
                "data" => $th->getMessage()
            ]);
        }
    }
}
