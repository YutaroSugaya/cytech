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
        $products = $this->ProductModel->getList();
            return view('showList', ['product' => $products]);
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
