<?php

namespace App\Http\Controllers;

use App\Models\CompanieModel;
use App\Models\ProductModel;
use App\Models\CrudModel;
use Illuminate\Http\Request;

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
        $model = $request->all();
        // $result = $this->CrudModel->get();


        return redirect(route('/home'));
    }


    /**
     *　編集フォームを表示する
     *　@param int $id
     * @return view
     */

    public function showEdit($id)
    {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     *　更新をする
     * @return view
     */

    public function exeUpdate(Request $request)
    {
        //データを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            //編集内容登録
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'productName' => $inputs['productName'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'company_name' => $inputs['company_name'],
                'content' => $inputs['content'],
                'image' => $inputs['image'],
            ]);
            $blog->save();
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', 'ブログを更新しました');
        return redirect(route('blogs'));
    }

    /**
     *　削除
     *　@param int $id
     * @return view
     */


    public function exeDelete($id)
    {

        $blog = Blog::destroy($id);
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return view('blog.list_child');
        }

        try {
            //データを削除
            Blog::destroy($id);
        } catch (\Throwable $e) {
            abort(500);
        }
        \Session::flash('err_msg', '削除しました。');
        return view('blog.list_child');
    }

}
