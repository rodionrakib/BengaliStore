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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace'=>'Admin'],function(){
    Route::get('/admin/login','LoginController@showLoginForm')->name('admin.login')->middleware('guest:employee');
    Route::post('/admin/login','LoginController@login')->name('admin.login');
});


Route::group(['namespace'=>'Admin','middleware'=>'employee:employee'],function(){
    Route::get('/admin/dashboard','DashboardController@home')->name('admin.dashboard');
    Route::get('/admin/users','UserController@index')->name('admin.users.index');
    Route::get('/admin/users/{user}/edit','UserController@edit')->name('admin.users.edit');
    Route::put('/admin/users/{user}','UserController@update')->name('admin.users.update');


});