<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ProductModel;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * 在庫を減らす処理
     * @param Illuminate\Http\Request
     */
    public function apiSales(Request $request)
    {
        $products = new ProductModel;
        $id = $request->id;
        $orderQuantity = $request->quantity;
        $product = ProductModel::find($id);
        $previousStock = $product->stock; // 変更前の在庫を保存

        if ($product->stock > $orderQuantity) {
            \DB::beginTransaction();
            try {
                $data = ['product_id' => $id];
                Sale::create($data);
                $product->decrement('stock', $orderQuantity);
                \DB::commit();
            } catch (\Throwable $e) {
                \DB::rollback();
                abort(500);
            }
            // 変更後の在庫数を取得してログに出力
            $product = ProductModel::find($id);
            log::debug('product_id:' . $id . ' quantity:' . $orderQuantity . ' stock:' . $previousStock . ' -> ' . $product->stock);
        } else {
            log::debug('Out of stock');
        }
    }

    /**
     *  在庫数を増やす処理
     * @param Illuminate\Http\Request
     */

    public function apiAdd(Request $request)
    {
        $products = new ProductModel;
        $id = $request->id;
        $orderQuantity = $request->quantity;
        $product = ProductModel::find($id);
        $previousStock = $product->stock; // 変更前の在庫を保存

        if ($product->stock > $orderQuantity) {
            \DB::beginTransaction();
            try {
                $data = ['product_id' => $id];
                Sale::create($data);
                $product->increment('stock', $orderQuantity);
                \DB::commit();
            } catch (\Throwable $e) {
                \DB::rollback();
                abort(500);
            }
            // 変更後の在庫数を取得してログに出力
            $product = ProductModel::find($id);
            log::debug('product_id:' . $id . ' quantity:' . $orderQuantity . ' stock:' . $previousStock . ' -> ' . $product->stock);
        } else {
            log::debug('Out of stock');
        }
    }
}
