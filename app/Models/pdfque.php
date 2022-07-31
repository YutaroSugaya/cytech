<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdfque extends Model
{
    use HasFactory;
    //テーブル名
    protected $table = 'pdfque';

    // 可変項目
    protected $fillable = [
        'pdf'
    ];
}
