<?php

namespace App\Helpers;

use App\Models\Category;

class CheckIdCategory {
    public static function checkIdCategoryNull ($id) {
        $result = Category::find($id);
        if ($result) {
            return true;
        }
        return false;
    }
}
