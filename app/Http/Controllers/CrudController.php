<?php

namespace App\Http\Controllers;

use App\Models\CompanieModel;
use App\Models\ProductModel;
use App\Models\CrudModel;
use Illuminate\Http\Request;
use DB;


class CrudController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct() {
        $this->middleware('auth');
        $this->CompanieModel = new CompanieModel();
        $this->ProductModel = new ProductModel();
        $this->CrudModel = new CrudModel();
    }


    //新規登録画面の表示
    public function showCreate() {
        return view('/showCreate');
    }

    /**
     *　詳細を表示する
     *　@param int $id
     * @return view
     */

    public function showDetail($id)
    {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        };
        return view('blog.Detail', ['blog' => $blog]);
    }



    /**
     *　新規登録をする
     * @return view
     */
    //BlogRequestを$requestという変数に入れる→$requestでデータを受け取れるようになる
    public function exeStore(Request $request) {
         //バリデーションチェック
        $this->validate($request, [
            'productName' => 'bail|required|max:255',
            'price'       => 'bail|required|max:9999999999|integer',
            'stock'       => 'bail|required|max:9999999999|integer',
            'comment'     => 'bail|required|max:1000'
        ]);
        $this->CrudModel->create($request);
        return redirect(route('showList'));
    }


    /**
     *　商品データを更新をする
     * @param $request
     * @return view
     */

    public function exeUpdate(Request $request)
    {
        //バリデーションチェック
        $this->validate($request,[
            'productName' => 'bail|required|max:255',
            'price'       => 'bail|required|max:9999999999|integer',
            'stock'       => 'bail|required|max:9999999999|integer',
            'comment'     => 'bail|required|max:1000'
        ]);

        //短縮記法
        DB::transaction(function () use ($request) {
            $products = ProductModel::find($request->id);
            $products->fill($request->all())->save();
        });

        // 従来の記法
        // \DB::beginTransaction();
        // try {
        //     //編集内容登録
        //     $products = ProductModel::find($request->id);
        //     $products->fill($request->all())->save();
        //     \DB::commit();
        // } catch (\Throwable $e) {
        //     \DB::rollback();
        //     abort(500);
        // }
        \Session::flash('err_msg', '商品を更新しました');
        return redirect(route('showList'));
    }

    /**
     *　削除
     *　@param int $id
     * @return view
     */


    public function exeDelete($id)
    {

        $products = ProductModel::destroy($id);
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return view('showList');
        }

        try {
            //データを削除
            ProductModel::destroy($id);
            \DB::commit();
            // $products->save();
        } catch (\Throwable $e) {
            abort(500);
        }
        \Session::flash('err_msg', '削除しました。');
        return view('showList');
    }
}
