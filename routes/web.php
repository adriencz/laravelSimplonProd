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


// POSTS
Route::get('/', 'PostsController@index')->name('index');
Route::get('/posts/create', 'PostsController@create')->middleware('auth:admin')->name('posts.create');
Route::post('/posts/store', 'PostsController@store')->middleware('auth:admin')->name('posts.store');
Route::get('/posts/edit/{id}', 'PostsController@edit')->middleware('auth:admin')->name('posts.edit')->where('id', '[0-9]+');
Route::put('/posts/update/{id}', 'PostsController@update')->middleware('auth:admin')->name('posts.update')->where('id', '[0-9]+');
Route::get('/posts/search', 'PostsController@search')->name('posts.search');
Route::delete('/posts/destroy/{id}', 'PostsController@destroy')->middleware('auth:admin')->name('posts.destroy')->where('id', '[0-9]+');
Route::get('/posts/{id}', 'PostsController@show')->name('posts.show')->where('id', '[0-9]+');


// ADMIN
Route::get('/admin/login', 'AdminsController@adminLoginForm')->name('admin.login.form');
Route::post('/admin/login', 'AdminsController@adminLogin')->name('admin.login');
Route::get('/admin/logout', 'AdminsController@adminLogout')->name('admin.logout');

// Auth::routes();
