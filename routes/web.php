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

Route::get('/', function () {
    return redirect('login');
})->name('home');
// Handle login routes
Route::get('/login', 'User\LoginController@show')->name('login');
Route::post('/login', 'User\LoginController@authenticate')->name('authenticate');
Route::get('/logout', 'User\LoginController@logout')->name('logout');

// Handle register routes
Route::get('/register', 'User\RegisterController@show')->name('register');
Route::post('/register', 'User\RegisterController@store')->name('store');

//Handle facebook routes
Route::get('auth/facebook', 'Ext\FacebookAuthController@redirectToProvider')->name('facebook');
Route::get('auth/facebook/callback', 'Ext\FacebookAuthController@handleProviderCallback')->name('facebook.callback');

// Handle authenticated routes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'User\ManagerController@show')->name('manager');
	Route::put('/home/user/update', 'User\ManagerController@update')->name('update');
	Route::post('/home/user/create', 'User\ManagerController@store')->name('create');
	Route::post('/home/user/delete', 'User\ManagerController@delete')->name('delete');
});
