<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientPageController;

use App\Events\MessageSent;
use Illuminate\Http\Request;

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

Route::get('/', 'ClientPageController@getHome');

Route::get('403', function () {
    return view('admin/errors/403');
})->name('403');

Route::get('admin/login', function(){
    return view('auth/login');
})->name('admin.login');
Route::post('sign_in', 'LoginController@authenticate')->name('sign_in');

Route::middleware('adminLogin')->prefix('admin')->group(function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('logout','LoginController@logout')->name('logout');

    Route::resource('admins', 'AdminController');
    Route::post('admins/delete_more', 'AdminController@deleteMore')->name('admins.delete_more')->middleware('can:isAdmin');
    Route::get('admins/profile/{id}', 'AdminController@getProfile')->name('admins.profile');
    Route::resource('users', 'UserController')->middleware('can:isAdminOrSale');
    Route::resource('products', 'ProductController');
    Route::resource('orders', 'OrderController')->middleware('can:isAdminOrSale');;
    Route::resource('invoices', 'InvoiceController')->middleware('can:isAdminOrSale');;
    Route::resource('importInvoices', 'ImportInvoiceController')->middleware('can:isAdminOrWarehouse');;
    Route::post('importInvoices/delete_more', 'ImportInvoiceController@deleteMore')->name('importInvoices.delete_more')->middleware('can:isAdmin');;
    Route::post('products/delete_more', 'ProductController@deleteMore')->name('products.delete_more')->middleware('can:isAdminOrWarehouse');
    Route::get('salaries/payroll', 'SalaryController@getPayroll')->name('salaries.payroll')->middleware('can:isAdmin');
    

    Route::resource('salaries', 'SalaryController')->middleware('can:isAdmin');;
    Route::resource('attendances', 'AttendanceController');
    Route::get('orders/prices/{id}', 'OrderController@getPrice');
    Route::get('orders/last_money/{id}', 'OrderController@getLastMoney');
});

Route::get('orders/prices/{id}', 'OrderController@getPrice');
Route::get('search/product_name', 'ProductController@searchByName');
Route::get('search/product_code', 'ProductController@searchByProductCode');
Route::get('home', 'ClientPageController@getHome')->name('client.home');
Route::get('products/{key}', 'ClientPageController@getProducts')->name('client.products');
Route::get('product_details/{id}', 'ClientPageController@getProductDetail')->name('client.product_details');
Route::get('carts','ClientPageController@getCart')->name('client.carts');
Route::get('sign_up','ClientPageController@getSignUp')->name('users.sign_up');
Route::get('promotion','ClientPageController@getPromotion')->name('users.promotion');
Route::post('sign_up','UserController@store')->name('users.sign_up.create');
Route::get('checkouts','ClientPageController@getCheckout')->name('client.checkouts');
Route::Post('checkouts/create','OrderController@store')->name('client.checkouts.create');
Route::get('checkouts/success','ClientPageController@checkoutSuccess')->name('client.checkout_success');

Route::post('users_sign_in', 'LoginController@userAuthenticate')->name('users.sign_in');
Route::get('user_logout','LoginController@userlogout')->name('users.logout');
Route::get('user_login','LoginController@userLogin')->name('users.login');
Route::get('contact','ClientPageController@getMail')->name('users.contact.index');
Route::post('contact', 'ClientPageController@storeMail')->name('users.contact');
Route::get('profile/{id}','ClientPageController@getProfile')->name('users.profile');
Route::post('profile/edit/{id}','UserController@update')->name('users.profile.update');

Route::get('ajax/districts/{id}', 'AjaxController@getDistricts');
Route::get('ajax/wards/{id}', 'AjaxController@getWards');
Route::get('ajax/comment', 'AjaxController@storeComment');
Route::get('ajax/addToCartAuth', 'ClientPageController@addToCart');
Route::get('ajax/updateCartAuth', 'ClientPageController@updateCart');
Route::get('ajax/product_models/create', 'AjaxController@storeProductModel');
Route::get('ajax/brands/create', 'AjaxController@storeBrand');
Route::get('ajax/changeStatus', 'AjaxController@changeStatus');
Route::get('ajax/changeOrderStatus', 'AjaxController@changeOrderStatus');
Route::get('ajax/check_quantity', 'AjaxController@checkQuantityCart');
Route::get('ajax/login', 'AjaxController@checkUserLogin');

Route::get('sender', function ()
{
    return view('sender');
});

// Route::post('sender', function (Request $request)
// {
//     // dd($request->all());
//     $text = $request->content;
//     // dd($text);
//     event(new MessageSent($text));
// });
