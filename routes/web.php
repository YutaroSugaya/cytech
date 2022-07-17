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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//ホーム画面を表示

Route::get('/home', [ShowListController::class, 'showList'])->name('showList');
Route::get('/home/showGetList', [ShowListController::class, 'showGetList'])->name('showGetList');

//ブログ画面一覧
// Route::get('/blog/blogs', 'BlogController@showList')->name('blogs');

// //記事一覧画面を表示する(2ページ目以降)
// Route::post('/blog/list', 'BlogController@fetchList')->name('list');


//新規登録画面
Route::get('/showCreate', [ShowListController::class, 'showCreate']);
//新規登録処理
Route::post('/showCreate/store', [CrudController::class, 'exeStore'])->name('exeStore');
//会社名取得する
Route::post('/showCreate/companyGet', [ShowListController::class, 'companyGet']);

//詳細編集画面
Route::get('/showUpdate/{id}', [ShowListController::class, 'showUpdate'])->name('showUpdate');

// Route::post('/showUpdate/update', 'BlogController@exeUpdate')->name('update');
Route::post('/showUpdate/update', [CrudController::class, 'exeUpdate'])->name('exeUpdate');

// //編集画面を表示
// Route::get('/blog/edit/{id}', 'BlogController@showEdit')->name('edit');

// //削除
// Route::post('/showDelete/{id}', [CrudController::class, 'exeDelete'])->name('exeDelete');
// Route::post('/showDelete/{id}', [ShowListController::class, 'exeDelete'])->name('exeDelete');
// Route::get('/showList/delete/{id}', [ShowListController::class, 'exeDelete'])->name('delete');
Route::post('/delete/{id}', [ShowListController::class, 'exeDelete'])->name('delete');

// Auth::routes();



// // 記事の検索をする
Route::post('/search/{keyword}', [ShowListController::class, 'search'])->name('search');
Route::post('/search2', [ShowListController::class, 'search2'])->name('search');

