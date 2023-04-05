<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;



class TestUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('home');
    }

    public function showList() {
        // インスタンス生成
        $model = new Article();
        $articles = $model->getList();

        return view('home', ['articles' => $articles]);
    }

    public function showAddForm() {
        return view('add');
    }

    public function addSubmit(ArticleRequest $request) {

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Article();
            $model->addArticle($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらaddにリダイレクト
        return redirect(route('add'));
    }

    public function delete($id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $model = new Article();
        $model->delete_data($id);
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('home');
    }
}

