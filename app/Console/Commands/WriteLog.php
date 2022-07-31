<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pdfque;
use DB;

class WriteLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'writeLog'; // コマンドの名前を設定

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ログ出力';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            Pdfque::insert([
                'pdf' => 'a2',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::commit();
            logger('成功'); // ここに自動化したい処理を書く。
        } catch (Exception $e) {
            DB::rollback();
            logger('失敗'); // ここに自動化したい処理を書く。
        }
    }
}
