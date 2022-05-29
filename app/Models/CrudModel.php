<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CrudModel extends Model
{
    use HasFactory;


    /**
     *　新規画面のデータを取得する
     * @param $request
     * @return $model
     * */

    public function create($request) {

       //データを受け取る
       $model = $request->all();

       \DB::beginTransaction();
       //登録
       ProductModel::create([
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
    }
}
