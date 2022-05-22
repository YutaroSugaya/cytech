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
     * @param
     * @return $request
     * */

    public function create(Request $request) {

       //データを受け取る
       $inputs = $request->all();
       \DB::beginTransaction();
       //登録
       Blog::create($inputs);
       \DB::commit();
       \Session::flash('err_msg', '商品を登録しました');

        return $request;
    }
}
