<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::post('customer', [App\Http\Controllers\CustomerController::class, 'store'])->name('create_customers');
	Route::get('edit_view_customer/{id}', [App\Http\Controllers\CustomerController::class, 'editView'])->name('edit_view_customers');
	Route::post('edit_customer', [App\Http\Controllers\CustomerController::class, 'update'])->name('update_customers');
	Route::post('search_customer', [App\Http\Controllers\CustomerController::class, 'searchSustomer'])->name('search_customer');


});

