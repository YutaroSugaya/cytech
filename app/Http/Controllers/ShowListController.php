<?php

namespace App\Http\Controllers;

use App\Models\CompanieModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ShowListController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct() {
        $this->middleware('auth');
        $this->CompanieModel = new CompanieModel();
        $this->ProductModel = new ProductModel();
    }


    /**
     * Show the application dashboard.
     *
     * @return view
     */
    public function showList() {
        $product = $this->ProductModel->getList();
            return view('showList', ['product' => $product]);
    }
    /**
     * 記事の検索
     *
     * @return view */

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            if ($request->ajax()) {
                $response = ProductModel::orderBy('id', 'asc')
                    ->where('productName', 'LIKE', "%{$keyword}%")
                    ->orWhere('company', 'LIKE', "%{$keyword}%")
                    ->paginate(10);
                return view('showList', compact('response'))->render();
            }
        }
    }

    /**
     * Show the application dashboard.
     * @param
     * @return $companies
     */
    public function showCreate() {
        $companies = $this->CompanieModel->companiesGet();
            return view('showCreate', ['companies' => $companies]);
    }

    /**
     * Show the application dashboard.
     * @param  $id
     * @return $product,$companies
     */
    public function showUpdate($id) {
        $products = ProductModel::find($id);
        if (is_null($products)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('showList'));
        }
        $companies = $this->CompanieModel->companiesGet();
        return view('showUpdate', ['product' => $products, 'companies' => $companies]);
    }
}
