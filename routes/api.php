<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')
     ->get('/user', function (Request $request) {
         return $request->user();
     });

Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => ['auth.basic', 'cors']], function () {
        Route::group(['prefix' => 'search'], function () {
            Route::post('/',        ['as' => 'search',          'uses' => 'SongController@search']);
            Route::post('/song',    ['as' => 'song.search',     'uses' => 'SongController@song']);
            Route::post('/video',   ['as' => 'video.search',    'uses' => 'SongController@video']);
        });
    });
});