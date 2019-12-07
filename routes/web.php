<?php
use App\comment;
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
Route::get('/test',function(){
    /*$arr=[
        [
            'name'=>'Abdelrhman',
            'age'=>21,
            'department'=>'CS'
        ],
        [
            'name'=>'Mohammad',
            'age'=>23,
            'department'=>'MIS'
        ],
        [
            'name'=>'Noman',
            'age'=>23,
            'department'=>'CIS'
        ],
        [
            'name'=>'Anas',
            'age'=>23,
            'department'=>'MIS'
        ],
        [
            'name'=>'Monther',
            'age'=>20,
            'department'=>'CS'
        ],
        [
            'name'=>'Ghassan',
            'age'=>23,
            'department'=>'CIS'
        ],
        [
            'name'=>'Mohammad',
            'age'=>23,
            'department'=>'CS'
        ],
        [
            'name'=>'Yousef',
            'age'=>22,
            'department'=>'CIS'
        ],
        [
            'name'=>'Ahmad',
            'age'=>22,
            'department'=>'CIS'
        ]
    ];
    return $arr->paginate(2);*/
    //comment::all()->paginate(1);
    //dd(storage_path().'app/public/images/default.jpeg');
    dd(pathinfo(storage_path().'app/public/images/default.jpeg'));
})->name('test');
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{post}/comments', 'HomeController@show')->name('comments');
Route::get('/{user}', 'userController@show')->name('user');