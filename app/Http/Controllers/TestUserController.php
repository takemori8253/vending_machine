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


    public function showList(Request $request){
        // インスタンス生成
        $article = Article::query();
        $model = new Article();

        // ページで入力された情報を取得
        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');
        $price_low = $request->input('price_low');
        $price_up = $request->input('price_up');
        $stock_low = $request->input('stock_low');
        $stock_up = $request->input('stock_up');

        // articlesテーブルから入力された情報を基にデータを取得
        $article = $model->getList($keyword, $company_id, $price_low, $price_up, $stock_low, $stock_up);

        // companiesテーブルからデータを取得
        $companies = $model->getCompaniesList();
        $articles = $article->paginate(100);

        return view('home', compact('articles', 'companies'));
    }

    public function showAddForm() {
        // インスタンス生成
        $model = new Article();
        // companiesテーブルからデータを取得
        $companies = $model->getCompaniesList();
        return view('add',['companies' => $companies]) ;
    }

    public function submitAddData(ArticleRequest $request) {

        // トランザクション開始
        DB::beginTransaction();

        try {
            // 登録処理呼び出し
            $model = new Article();
            $model->addProductData($request);
            DB::commit();
        } catch (\Exception $e) {
            // エラー発生時はロールバック処理を行う
            DB::rollback();
            return back();
        }

        // 処理が完了したらaddにリダイレクト
        return redirect(route('addForm'));
    }

    public function deleteData($id)
    {
        // インスタンス生成
        $model = new Article();
        // 削除処理を呼び出す
        $model->deleteDataByID($id);
    }

    public function showDetailForm($id) {
        // インスタンス生成
        $model = new Article();
        $articles = $model->getDetailListByID($id);

        return view('syousai', ['articles' => $articles]);
    }


    public function showEditForm($id) {
        // インスタンス生成
        $model = new Article();
        // companiesテーブルからデータを取得
        $companies = $model->getCompaniesList();
        // productsテーブルからデータを取得
        $product = $model->getProductListByID($id);

        return view('hensyu',compact('companies','id','product')) ;
    }

    public function updateProduct(ArticleRequest $request,$id) {

        // トランザクション開始
        DB::beginTransaction();

        try {
            // 編集処理呼び出し
            $model = new Article();
            $model->updateProductData($request,$id);
            DB::commit();
        } catch (\Exception $e) {
            // エラー発生時はロールバック処理を行う
            DB::rollback();
            return back();
        }
        return redirect(route('EditForm', ['id'=>$id]) );
    }
}

