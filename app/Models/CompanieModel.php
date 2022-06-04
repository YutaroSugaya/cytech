<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Kyslik\ColumnSortable\Sortable;// 追加

class CompanieModel extends Model
{
    use HasFactory;
    use Sortable; //ソート順表示

    //テーブル名
    protected $table = 'companies';

    public $sortable = [
        'company_name'
    ];

    public function companiesGet() {

        $query = DB::table($this->table);
        $query->select([
            'id',
            'company_name',
            'street_address',
            'representative_name'
        ]);

        $obj = $query->from('companies')
                     ->get();
        return $obj;
    }
}
