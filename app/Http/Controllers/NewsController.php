<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Helpers\CheckIdCategory;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function getAllNews()
    {
        try {

            $data = DB::select('SELECT news.*, categories.title as category_name FROM news, categories WHERE news.category_id = categories.id');

            return response() -> json([
                "error" => "False",
                "data" => $data,
            ]);
        } catch (\Throwable $th) {
            return response() -> json([
                "error" => "True",
                "data" => $th->getMessage()
            ]);
        }
    }

    public function postNews(Request $req)
    {

        $checkIdCategory = CheckIdCategory::checkIdCategoryNull($req->category_id);

        try {

            if (!$checkIdCategory) {
                return response()->json([
                    "error" => "false",
                    "status" => "success",
                    "message" => "Khong tim thay category"
                ]);
            }

            $this->validate($req, [
                "title" => "required",
                "body" => "required"
            ]);

            $post = new News();
            $post->title = $req->title;
            $post->body = $req->body;
            $post->category_id = $req->category_id;

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

    public function updateNews(Request $req, $id) {

        $checkIdCategory = CheckIdCategory::checkIdCategoryNull($req->category_id);

        try {

            if (!$checkIdCategory) {
                return response()->json([
                    "error" => "false",
                    "status" => "success",
                    "message" => "Khong tim thay category"
                ]);
            }

            $post = News::find($id);
            $post->title = $req->title;
            $post->body = $req->body;
            $post->category_id = $req->category_id;

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

    public function deleteNews($id) {
        try {
            $post = News::find($id);

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
            $data = DB::select('SELECT news.*, categories.title as category_name FROM news, categories WHERE news.category_id = categories.id AND news.id = ?', [$id]);

            if ($data)
            {
                return response()->json([
                    "error" => "false",
                    "data" => $data
                ]);
            }
            else
            {
                return response()->json([
                    "error" => "false",
                    "data" => "Not Found"
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "error" => "false",
                "data" => $th->getMessage()
            ]);
        }
    }
}
