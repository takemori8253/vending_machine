<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    public function getList() {
        // articlesテーブルからデータを取得
        $articles = DB::table('users')->get();

        return $articles;
    }
}