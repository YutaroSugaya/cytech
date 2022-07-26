<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        logger('test');// ここに自動化したい処理を書く。
    }
}
