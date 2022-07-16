<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductModel;

use DB;

class CrudModel extends Model
{
    use HasFactory;


    /**
     *　新規画面のデータを取得する
     * @param $request
     * @return $model
     * */

    public function create($request)
    {
        //短縮記法
        DB::transaction(function () use ($request) {
            $model = $request->all();
            $model = ProductModel::create([
                'company_id'  => $model['company_name'],
                'productName' => $model['productName'],
                'price'       => $model['price'],
                'stock'       => $model['stock'],
                'comment'     => $model['comment'],
                'image_path'  => $model['image_path'],
            ]);
            \DB::commit();
            \Session::flash('err_msg', '商品を登録しました');
            return $model;
        });
    }
}
