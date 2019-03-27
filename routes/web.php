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

Route::get('/', 'HomepageController@homepage')->name('homepage');

Route::get('/danh-muc/{class?}/{subject?}/{page?}', 'CategoryController@category')->name('category');

Route::get('/bai-viet/{post_id}', 'DetailController@detail')->name('detail');

Route::get('/dang-nhap/{error?}', 'AuthController@getLogin')->name('login');
Route::post('/dang-nhap', 'AuthController@postLogin')->name('login');

Route::get('/dang-ky/{error?}', 'AuthController@getSignup')->name('signup');
Route::post('/dang-ky', 'AuthController@postSignup')->name('signup');

Route::get('/dang-xuat', 'AuthController@logout');

Route::group(['prefix' => 'nguoi-dung', 'middleware' => 'userLogin'], function () {
    Route::get('/thong-tin-ca-nhan', 'UserController@getInformation')->name('user.information');

    Route::get('/cap-nhat-thong-tin/{error?}', 'UserController@getUpdateInfo')->name('user.update');
    Route::post('/cap-nhat-thong-tin', 'UserController@postUpdateInfo')->name('user.update');

    Route::get('/quan-ly-bai-viet', 'UserController@postManagement')->name('user.postManagement');

    Route::get('/sua-bai-viet/{post_id}/{error?}', 'UserController@getEditPost')->name('user.edit');
    Route::post('/sua-bai-viet/{post_id}', 'UserController@postEditPost')->name('user.edit');

    Route::get('/dang-bai/{error?}', 'UserController@getPostCreate')->name('user.postCreate');
    Route::post('/dang-bai', 'UserController@postPostCreate')->name('user.postCreate');

    //API
    Route::get('/xoa-bai/{post_id}', 'SearchController@deletePost');
    Route::get('/tim-chu-de/{class}', 'SearchController@searchSubjects');
});

// API
Route::get('/tim-kiem-bai-viet/{keyword}', 'SearchController@searchPost');
Route::get('/tim-kiem-tab/{subject_id}', 'SearchController@searchTabPost');

