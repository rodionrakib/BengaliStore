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
    Route::patch('/cart/{rowId}', 'CartController@update')->name('cart.update');
  	Route::get('/cart', 'CartController@index')->name('cart.index');
    
    Route::delete('/cart/{rowId}', 'CartController@destroy')->name('cart.destroy');
    Route::get('/empty', 'CartController@empty')->name('cart.empty');

    Route::post('customer/wishlists', 'WishlistController@store')->name('wishlist.store')->middleware('auth');
    Route::delete('/customer/wishlists/{product}', 'WishlistController@destroy')->name('wishlist.destroy')->middleware('auth');


  	Route::get('/products/{slug}', 'ProductController@show')->name('front.products.show');
    Route::get('/categories/{slug1}/{slug2?}/{slug3?}', 'ProductCategoryController@show')->name('front.categories.show');

});


Route::group(['namespace'=>'Front' , 'middleware' => 'auth' ],function(){
    Route::get('accounts/profile', 'AccountsController@profile')->name('accounts.profile');
    Route::get('accounts/order', 'AccountsController@order')->name('accounts.order');
    Route::get('accounts/address', 'AccountsController@address')->name('accounts.address');
    Route::get('accounts/wishlists', 'WishlistController@index')->name('wishlist.index');
    // Route::get('accounts/wishlists/erase', 'WishlistController@destroy')->name('wishlist.destroy');

    Route::post('accounts/address', 'CustomerAddressController@store')->name('accounts.address.store');
    Route::get('accounts/address/create', 'CustomerAddressController@create')->name('accounts.address.create');
    Route::get('accounts/address/{address}/edit', 'CustomerAddressController@edit')->name('accounts.address.edit');

    Route::patch('accounts/address/{address}', 'CustomerAddressController@update')->name('accounts.address.update');
    Route::delete('accounts/address/{address}', 'CustomerAddressController@destroy')->name('accounts.address.delete');


    // Route::resource('accounts.address', 'CustomerAddressController');

    Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('checkout', 'CheckoutController@store')->name('checkout.store');
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


// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END