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

Route::get('/dang-nhap/{error?}', 'AuthController@getLogin');
Route::post('/dang-nhap', 'AuthController@postLogin');

Route::get('/dang-ky/{error?}', 'AuthController@getSignup');
Route::post('/dang-ky', 'AuthController@postSignup');

Route::get('/dang-xuat', 'AuthController@logout');

Route::group(['middleware' => 'web'], function () {
    Route::group(['prefix' => 'nguoi-dung', 'middleware' => 'userLogin'], function() {
        Route::get('/thong-tin-ca-nhan', 'UserController@getInformation');
        Route::get('/cap-nhat-thong-tin/{error?}', 'UserController@getUpdateInfo');
        Route::post('/cap-nhat-thong-tin', 'UserController@postUpdateInfo');
        Route::get('/quan-ly-bai-viet', 'UserController@postManagement');
        Route::get('/sua-bai-vet/{post_id}/{error?}', 'UserController@getEditPost');
        Route::post('/sua-bai-viet/{post_id}', 'UserController@postEditPost');
        Route::get('/dang-bai/{error?}', 'UserController@getPostCreate');
        Route::post('/dang-bai', 'UserController@postPostCreate');

        //API
        Route::get('/xoa-bai/{post_id}', 'SearchController@deletePost');
        Route::get('/tim-chu-de/{class}', 'SearchController@searchSubjects');
    });
});

// API
Route::get('/tim-kiem-bai-viet/{keyword}', 'SearchController@searchPost');
Route::get('/tim-kiem-tab/{subject_id}', 'SearchController@searchTabPost');

