<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Sales;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //バリテーション
        $request->validate([
            'product_id' => 'required',
        ]);

        $sales = new Sales();
        $productId = $request->input('product_id');
        //在庫数取得
        $stock = $sales->getstock($productId);

        if ($stock === 0) { // === 演算子を使用して厳密な比較を行う
            return response()->json(['error' => '在庫がありません。'], 400);
        }
        //購入処理
        $sales->buy($productId);
        //データ追加処理
        $sales->add($productId);
        return response()->json(['message' => $stock], 200);
    }
}
