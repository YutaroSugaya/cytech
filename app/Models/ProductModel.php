<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ProductModel extends Model
{
    use HasFactory;
    // use Sortable; //ソート順表示

    //テーブル名
    protected $table = 'products';
    //プライマリーキー
    // public $productsId = 'products.id';

    // public function getCompanies() {
    //     $query = DB::table($this->table);
    //     $query->select([
    //         $this->productsId,
    //         'company_id'
    //     ]);
    //     $query->where($this->productsId,);

    // }



    /**
     *　一覧画面のデータを取得する
     * @return view
     * */

    public function getList() {

        $query = DB::table($this->table);
        $query->select([
            'products.id',
            'company_id',
            'productName',
            'price',
            'stock',
            'comment',
            'image_path',
            'company_name'
        ]);

        $obj = $query->from('products')->join('companies as com','company_id','com.id')->get();
        // $query->leftjoin('companies','companies.id','products.companie_id')->get();
        // $companies = DB::table('products')->join('companies','companies.id','=','products.companie_id')->get();
        // $test = $query;
        $obj = $query->get();
        return $obj;
    }

}
