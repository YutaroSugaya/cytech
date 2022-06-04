<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;// 追加
use DB;

class ProductModel extends Model
{
    use HasFactory;
    use Sortable; //ソート順表示

    //テーブル名
    protected $table = 'products';

    //可変項目
    protected $fillable = [
        'company_id',
        'productName',
        'price',
        'stock',
        'comment',
        'image_path'
    ];

    //ソートに使うカラムを指定
    public $sortable = [
        'id',
        'productName',
        'price',
        'stock',
        'company_name',
        'company_id'
    ];

    /**
     *　一覧画面のデータを取得する
     * @param
     * @return $obj
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
        //productsテーブルのIDとcpmpaniesテーブルのIDを紐付けする
        $obj = $query->from('products')
                     ->leftjoin('companies as com','company_id','com.id')
                     ->get();
        return $obj;
    }

}
