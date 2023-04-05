<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{

    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'created_at',
        'updated_at',
    ];

    public function getList() {
        // articlesテーブルからデータを取得
        $articles = DB::table('products')->get();

        return $articles;
    }

    public function delete_data($id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $data = DB::table('products')->where('id', $id);
        // レコードを削除
        $data->delete();
    }

    public function addArticle($data) {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'price' => $data->price,
            'comment' => $data->comment,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);
    }
}