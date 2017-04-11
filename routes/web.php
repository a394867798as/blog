<?php


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
Route::get('/nowTime',function(){
   echo date("Y-m-d H:i:s", time()); 
});
Route::get('user/{name}', function ($name) {
    return 'Hello '.$name;
});

Auth::routes();

Route::get('/home', 'HomeController@index');
//文章相关路由
Route::get('/article', 'ArticleController@index');
Route::get('/article/show/{id}', 'ArticleController@show');
Route::get('/article/create', 'ArticleController@create');
Route::post('/article/store', 'ArticleController@store');