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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//ホーム画面を表示

Route::get('/home', [ShowListController::class, 'showList']);

//ブログ画面一覧
// Route::get('/blog/blogs', 'BlogController@showList')->name('blogs');

// //記事一覧画面を表示する(2ページ目以降)
// Route::post('/blog/list', 'BlogController@fetchList')->name('list');


// //登録画面
Route::get('/showCreate', [ShowListController::class, 'showCreate']);

// //登録
// Route::post('/blog/store', 'BlogController@exeStore')->name('store');
Route::post('/showCreate/store', [CrudController::class, 'exeStore'])->name('exeStore');


// //詳細画面
// Route::get('/blog/{id}', 'BlogController@showDetail')->name('show');

// //編集画面を表示
// Route::get('/blog/edit/{id}', 'BlogController@showEdit')->name('edit');

// //商品の更新
// Route::post('/blog/update', 'BlogController@exeUpdate')->name('update');

// //削除
// Route::post('/blog/delete/{ID}', 'BlogController@exeDelete')->name('delete');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// // 検索機能
// //Route::get('/search', 'BlogController@getSearch')->name('search');


// // 記事の検索をする
// Route::post('/blog/search/{keyword}', 'BlogController@search')->name('search');

// // 記事の検索をする
// Route::post('/blog/search/{number}', 'BlogController@search')->name('number1');
// Route::post('/blog/search/{number}', 'BlogController@search')->name('number2');
// Route::post('/blog/search/{number}', 'BlogController@search')->name('number3');
// Route::post('/blog/search/{number}', 'BlogController@search')->name('number4');


// Route::get('api/test', 'TestAPIController@index');
