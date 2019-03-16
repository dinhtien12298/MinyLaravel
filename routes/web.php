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

Route::get('/', 'HomepageController@homepage');

Route::get('/danh-muc/{class?}/{subject?}/{page?}', 'CategoryController@category');

Route::get('/bai-viet/{post_id}', 'DetailController@detail');