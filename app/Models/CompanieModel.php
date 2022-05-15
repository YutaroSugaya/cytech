<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class CompanieModel extends Model
{
    use HasFactory;

    //テーブル名
    protected $table = 'companies';

    //可変項目 データベースに保存していいものを入れる
    // protected $fillable =
    // [
    //     'company_name',
    //     'street_address',
    //     'representative_name',
    // ];

    public function companiesGet() {

        $query = DB::table($this->table);
        $query->select([
            'id',
            'company_name',
            'street_address',
            'representative_name'
        ]);
        $query->get();

        return $query;
    }
}
