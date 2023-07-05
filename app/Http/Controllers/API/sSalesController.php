<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Sales;

class SalesController extends Controller
{
    public function Sales(Request $request)
    {
        // リクエストパラメータのバリデーション
        $request->validate([
            'product_id' => 'required',
        ]);

        $sales = new Sales();
        $productId = $request->input('product_id');
        $sales->add($productId);
        /*
        $product = Article::find($productId);

        // 在庫が0の場合はエラーレスポンスを返す
        if ($product->stock === 0) {
            return response()->json(['error' => '在庫がありません。'], 400);
        }

        // 在庫数を減算
        $product->stock--;
        $product->save();

        // salesテーブルにレコードを追加
        $sale = new Sales();
        $sale->product_id = $productId;
        $sale->created_at = NOW();
        $sale->updated_at = NOW();
        $sale->save();

        echo json_encode($productId);
        */

        return response()->json(['message' => 'Success'], 200);
    }
}
