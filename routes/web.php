<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::prefix('do')->group(function() {
    Route::get('/list-do', 'DoController@list')->name('list_do');
    Route::get('/create', 'DoController@create')->name('create_do');
    Route::get('/update/{id}', 'DoController@update')->name('update_do');
    Route::get('/data', 'DoController@getData')->name('data_do');
    Route::post('/save', 'DoController@save')->name('save_do');
    Route::get('/getdata', 'DoController@getData')->name('getdatado');
    Route::get('/mover', 'DoController@mover')->name('mover');
    Route::post('/saveupdate', 'DoController@saveupdate')->name('saveupdate_do');
    Route::get('/print/{id}', 'DoController@print')->name('print_do');
    Route::post('/status-update', 'DoController@updateDoStatus')->name('status_update_do');

    
});

Route::prefix('rfs')->group(function() {
  
    Route::get('/create', 'RFSController@create')->name('create_rfs');
    Route::get('/update/{id}', 'RFSController@update')->name('update_rfs');
    Route::post('/save', 'RFSController@save')->name('save_rfs');
    Route::post('/saveupdate', 'RFSController@saveupdate')->name('saveupdate_rfs');
    Route::get('/getdata', 'RFSController@getData')->name('getdatarfs');
    Route::get('/{id}', 'RFSController@createid')->name('id_rfs');
    Route::get('/find/{id}', 'RFSController@findid')->name('findid_rfs');
    Route::get('/delete/{id}', 'RFSController@delete')->name('delete_rfs');
    Route::get('itemdata/{id}', 'RFSController@itemdata')->name('itemdata_rfs');
    // Route::get('/data', 'DoController@getData')->name('data');
});

Route::prefix('spk')->group(function() {
    Route::get('/list', 'SPKController@list')->name('list_spk');
    Route::get('/view/{id}', 'SPKController@spk')->name('spk');
    Route::get('/create', 'SPKController@create')->name('create');
    Route::get('/update/{id}', 'SPKController@update')->name('update_spk');
    Route::post('/save', 'SPKController@save')->name('save_spk');
    Route::post('/saveupdate', 'SPKController@saveupdate')->name('save_update_spk');
    Route::post('/additem', 'SPKController@addItem')->name('add_item_spk');
    Route::get('/dodata', 'SPKController@doData')->name('dodata');
    Route::get('/getdata', 'SPKController@getData')->name('getdataspk');
    Route::get('/getitemspk/{id}', 'SPKController@getItemSPK')->name('getitemspk');
    Route::get('/deleteitemspk/{id}', 'SPKController@deleteItem')->name('delete_item_spk');
});

Route::prefix('site')->group(function() {
    // Route::get('/list', 'DoController@list')->name('list');
    Route::get('/create', 'SiteController@create')->name('create');
    Route::post('/save', 'SiteController@save')->name('save');
    Route::get('/list', 'SiteController@list')->name('list');
 
    Route::get('/getdata', 'SiteController@getData')->name('getdatasite');
    Route::get('/datasite/{id}', 'SiteController@datasite')->name('datasite');
    // Route::get('/data', 'DoController@getData')->name('data');
});

Route::prefix('report')->group(function() {
    Route::get('/create', 'SPKController@create')->name('create');
    Route::get('/list-rfs', 'RFSController@list')->name('list_rfs');
});