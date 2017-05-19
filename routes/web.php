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

Route::group(['prefix'=>'api','middleware'=>'token.verifier'],function (){
    Route::group(['prefix'=>'v1'],function (){
        Route::post('song/search',  ['as'   =>  'test.search'   ,'uses'    =>  'SongController@search']);
    });
});

Route::get('/videos',   ['as'   =>  'testIndex'    ,'uses'    =>  'TestController@index']);
Route::post('/search',  ['as'   =>  'testSearch'   ,'uses'    =>  'TestController@search']);