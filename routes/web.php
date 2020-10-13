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

Route::get('/', 'Front\ProductController@home')->name('home');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace'=>'Front'],function(){
  	Route::post('/cart', 'CartController@store')->name('cart.store');
  	Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
    Route::get('/empty', 'CartController@empty')->name('cart.empty');


    Route::get('/checkout/shipping', 'CheckoutController@shipping')->name('checkout.shipping');
    Route::post('/checkout/shipping', 'CheckoutController@shippingStore')->name('checkout.shipping.store');

    Route::get('/checkout/payment', 'CheckoutController@payment')->name('checkout.payment');





  	Route::get('/products/{slug}', 'ProductController@show')->name('front.products.show');
    Route::get('/categories/{slug}', 'ProductCategoryController@show')->name('front.categories.show');

});







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



Route::group(['namespace'=>'Admin','middleware'=>'employee:employee', 'prefix'=>'admin'],function(){
    Route::resource('products','ProductController',['as' => 'admin']);
    Route::get('product/remove/thums/{id}','MediaController@remove')->name('admin.product.remove.thumb'); 
    Route::get('product/remove/cover/{id}','MediaController@remove')->name('admin.product.remove.cover');  
});

Route::group(['namespace'=>'Admin','middleware'=>'employee:employee', 'prefix'=>'admin'],function(){
    Route::resource('categories','ProductCategoryController',['as' => 'admin']);  
});