<?php

namespace App\Http\Controllers;

use App\Models\CompanieModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ShowListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->CompanieModel = new CompanieModel();
        $this->ProductModel = new ProductModel();
    }


    /**
     * Show the application dashboard.
     *
     * @return view
     */
    public function showList()
    {
        $product = $this->ProductModel->getModel()->getList();
        return view('showList',['product' => $product]);
    }

    /**
     * Show the application dashboard.
     *
     * @return view
     */
    public function showGetList()
    {
        $result = $this->ProductModel->getModel()->getList();
        return $result;
    }

    /**
     * 記事の検索
     *
     * @return view */

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $response = ProductModel::select([
                'products.id',
                'company_id',
                'productName',
                'price',
                'stock',
                'comment',
                'image_path',
                'company_name'])
                ->from('products')
                ->leftJoin('companies as com','company_id','com.id')
                ->where('productName', 'LIKE', "%{$keyword}%")
                ->orWhere('company_name', 'LIKE', "%{$keyword}%")
                ->orWhere('stock', 'LIKE', "%{$keyword}%")
                ->get();
            return $response;
        } else {
            $result = $this->ProductModel->getModel()->getList();
            return $result;
        }
    }

    /**
     * 記事の検索
     *
     * @return view */

    public function search2(Request $request)
    {

        $topPrice = intval($request->topPrice);
        $underPrice = intval($request->underPrice);
        if (!empty($topPrice) && !empty($underPrice)) {
            $response = ProductModel::select([
                'products.id',
                'company_id',
                'productName',
                'price',
                'stock',
                'comment',
                'image_path',
                'company_name'])
                ->from('products')
                ->leftJoin('companies as com','company_id','com.id')
                ->whereBetween('price',[$underPrice, $topPrice])
                ->get();
            return $response;
        } else {
            $result = $this->ProductModel->getModel()->getList();
            return $result;
        }
    }

    /**
     * Show the application dashboard.
     * @param
     * @return $companies
     */
    public function showCreate()
    {
        $companies = $this->CompanieModel->companiesGet();
        return view('showCreate', ['companies' => $companies]);
    }

    /**
     * Show the application dashboard.
     * @param  $id
     * @return $product,$companies
     */
    public function showUpdate($id)
    {
        $products = ProductModel::find($id);
        if (is_null($products)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('showList'));
        }
        $companies = $this->CompanieModel->companiesGet();
        return view('showUpdate', ['product' => $products, 'companies' => $companies]);
    }
}
