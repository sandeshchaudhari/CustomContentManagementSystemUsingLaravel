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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/admin/users','AdminUsersController');

//Route::get('/admin/users',function (){
//   return view('admin.users.index');
//});

Route::get('/test',function(){
    return User::find(1)->role->name;
});
Route::get('/admin',function(){
   return view('admin.index');
});