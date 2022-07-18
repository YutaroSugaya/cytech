<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowListController;
use App\Http\Controllers\CrudController;
use App\Models\CrudModel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//ホーム画面を表示

Route::get('/home', [ShowListController::class, 'showList'])->name('showList');
Route::get('/home/showGetList', [ShowListController::class, 'showGetList'])->name('showGetList');

//新規登録画面
Route::get('/showCreate', [ShowListController::class, 'showCreate']);
//新規登録する
Route::post('/showCreate/store', [CrudController::class, 'exeStore'])->name('exeStore');
//会社名取得する
Route::post('/showCreate/companyGet', [ShowListController::class, 'companyGet']);

//詳細編集画面表示
Route::get('/showUpdate/{id}', [ShowListController::class, 'showUpdate'])->name('showUpdate');
//更新をする
Route::post('/showUpdate/update', [CrudController::class, 'exeUpdate'])->name('exeUpdate');

//削除をする
Route::post('/delete/{id}', [ShowListController::class, 'exeDelete'])->name('delete');

// 検索をする
Route::post('/search/{keyword}', [ShowListController::class, 'search'])->name('search');
Route::post('/search2', [ShowListController::class, 'search2'])->name('search');

