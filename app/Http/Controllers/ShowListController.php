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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showList() {
        $products = $this->ProductModel->getList();
        $companies = $this->CompanieModel->companiesGet();

        foreach($products as $product) {
            return view('showList', compact('product'));
        }
    }
}
