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

Route::get('/roles', 'RoleController@index');
Route::post('/roleadd', 'RoleController@store');
Route::put('/roleupdate/{id}', 'RoleController@update');
Route::delete('/roledelete/{id}', 'RoleController@destroy');

Route::get('/category', 'CategoryController@index');
Route::post('/categoryadd', 'CategoryController@store');
Route::put('/categoryupdate/{id}', 'CategoryController@update');
Route::delete('/categorydelete/{id}', 'CategoryController@destroy');
