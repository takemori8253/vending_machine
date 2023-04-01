<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;


class TestUserController extends Controller
{
    public function showList() {
        // インスタンス生成
        $model = new Article();
        $articles = $model->getList();

        return view('test_view', ['articles' => $articles]);
    }
}