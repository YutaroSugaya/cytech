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
     *
     * @return view
     */
    public function showCreate() {
        $companies = $this->CompanieModel->companiesGet();
            return view('showCreate', ['companies' => $companies]);
    }

}
