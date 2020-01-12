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
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/roles', 'RoleController@index');
	Route::post('/roleadd', 'RoleController@store');
	Route::put('/roleupdate/{id}', 'RoleController@update');
	Route::delete('/roledelete/{id}', 'RoleController@destroy');

	Route::get('/category', 'CategoryController@index');
	Route::post('/categoryadd', 'CategoryController@store');
	Route::put('/categoryupdate/{id}', 'CategoryController@update');
	Route::delete('/categorydelete/{id}', 'CategoryController@destroy');

	Route::get('/user', 'UserController@index');
	Route::post('/useradd', 'UserController@store');
	Route::put('/userupdate/{id}', 'UserController@update');
	Route::delete('/userdelete/{id}', 'UserController@destroy');
	
	Route::get('/changepassword', 'UserController@edit_password');
	Route::put('/update_password/{id}', 'UserController@update_password');


	Route::get('/expense', 'ExpenseController@index');
	Route::post('/expenseadd', 'ExpenseController@store');
	Route::put('/expenseupdate/{id}', 'ExpenseController@update');
	Route::delete('/expensedelete/{id}', 'ExpenseController@destroy');

	Route::get('/dashboard', 'DashboardController@index');

	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
});



Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

// Route::get('/home', 'HomeController@index')->name('home');
