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
        Route::get('test/search/{params}/{quantity}',['as'=>'test.search','uses'=>'TestController@search']);
    });
});