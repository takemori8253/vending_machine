<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Kyslik\ColumnSortable\Sortable;

class Article extends Model
{
    use Sortable;

    use HasFactory;

    protected $table = 'products';

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



    public function getList($syouhin, $maker, $price_low, $price_up, $stock_low, $stock_up) {
        // articlesテーブルからデータを取得
        $articles = DB::query();
        $articles = Article::sortable('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
        ->select('products.id', 'products.img_path', 'products.product_name','products.price','products.stock','companies.company_name' );

        //商品名が入力されていたら、商品名の部分検索を行う
        if (!empty($syouhin)) {
            $articles->where('products.product_name', 'LIKE', "%{$syouhin}%");
        }

        //企業名が指定されていたら、企業名に該当する商品を表示する
        if (!empty($maker)) {
            $articles->where('company_id', $maker);
        }

        if(!empty($price_low)) {
            $articles->where('price','>=',$price_low);
        }

        if(!empty($price_up)) {
            $articles->where('price','<=',$price_up);
        }

        if(!empty($stock_low)) {
            $articles->where('stock','>=',$stock_low);
        }

        if(!empty($stock_up)) {
            $articles->where('stock','<=',$stock_up);
        }

        $articles->orderByDesc('products.id');

        return $articles;
    }

    public function getProductListByID($id) {
        // productsテーブルからIDをもとにデータを取得
        $articles = DB::table('products')
        ->find($id);

        return $articles;
    }

    public function getDetailListByID($id) {
        // articlesテーブルからデータを取得
        $articles = DB::table('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
        ->select( 'products.id', 'products.img_path', 'products.product_name', 'companies.company_name', 'products.price','products.stock', 'products.comment' )
        ->where('products.id' ,'=', $id)
        ->get();

        return $articles;
    }

    public function getCompaniesList() {
        // companiesテーブルからデータを取得
        $articles = DB::table('companies')->get();
        return $articles;

    }

    public function deleteDataByID($id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $data = DB::table('products')->where('id', $id);
        // レコードを削除
        $data->delete();
    }

    public function addProductData($data) {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);
    }

    public function updateProductData($data,$id) {
        // 更新処理
        $table = DB::table('products')->where('id', $id);
        $table->update([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
            'updated_at' => NOW(),
        ]);
    }
}

class Company extends Model
{

    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'id',
        'company_name',
        'street_address',
        'representative_name',
        'created_at',
        'updated_at',
    ];
}
