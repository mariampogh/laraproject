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


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/getProducts/{id}/', 'HomeController@getProducts');
Route::post('/searchProduct', 'HomeController@searchProduct');
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~ADMIN~~~~~~~~~~~~~~~~~~~~//
Route::get('/admin', 'AdminController@admin');
Route::post('/addCategory','AdminController@addCategory');
Route::post('/editCategory','AdminController@editCategory');
Route::post('/deleteCategory','AdminController@deleteCategory');
Route::get('/adminCatProducts/{id}','AdminController@productsOfCategory');
Route::any('/addProduct/{cat_id}','AdminController@addProduct');
Route::any('/editProduct','AdminController@editProduct');
Route::post('/deleteProduct/{id}','AdminController@deleteProduct');
