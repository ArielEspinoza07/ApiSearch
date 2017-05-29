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

Route::group(['prefix'=>'api'],function (){
    Route::group(['prefix'=>'v1'],function (){
        Route::group(['middleware'=>'token.verifier'],function (){
            Route::post('video/search'      ,  ['as'   =>  'test.search'   ,'uses'    =>  'SongController@video']);
            Route::post('song/search'       ,  ['as'   =>  'test.search'   ,'uses'    =>  'SongController@search']);
        });
        Route::post('generate/token'    ,  ['as'   =>  'test.search'   ,'uses'    =>  'TokenController@generateToken']);
    });
});

Route::get('/videos',   ['as'   =>  'testIndex'    ,'uses'    =>  'TestController@index']);
Route::post('/search',  ['as'   =>  'testSearch'   ,'uses'    =>  'TestController@search']);