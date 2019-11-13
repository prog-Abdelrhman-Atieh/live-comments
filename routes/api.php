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
Route::get('/posts/{post}/comments','CommentController@index');
Route::post('/posts','CommentController@show');
Route::post('/addPost/{user}','userController@addP');
Route::post( '/saveComm','CommentController@saveCom');
Route::middleware('auth:api')->group(function () {
    Route::post('/posts/{post}/comment','CommentController@store');
});
