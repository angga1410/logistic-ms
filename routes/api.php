<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/list-do', 'DoController@listDO')->name('list_do');


Route::get('/list-do-detail/{id}', 'DoController@listDODetail')->name('list_do_detail');
Route::get('/list-do-today', 'DoController@getDataApi')->name('list_do_detail');
Route::get('/update-do/{id}', 'DoController@doUpdate')->name('update_do_status');
Route::get('/list-do/{id}', 'DoController@listDOAPI')->name('list_do_api');
Route::get('/do-detail/{id}', 'DoController@listDODetailAPI')->name('list_do_detail_api');
Route::get('/get-do/{id}', 'DoController@doDetailAPI')->name('get_do_api');


