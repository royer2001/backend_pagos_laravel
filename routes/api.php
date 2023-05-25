<?php

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('customers/index', 'CustomerController@index')->name('Customer.index');
Route::post('customers/save', 'CustomerController@store')->name('Customer.store');
Route::post('customers/edit', 'CustomerController@update')->name('Customer.update');
Route::post('customers/delete', 'CustomerController@destroy')->name('Customer.destroy');
Route::post('customers/show', 'CustomerController@show')->name('Customer.show');
Route::post('customers/delete_payment', 'CustomerController@deletePayment')->name('Customer.deletePayment');


