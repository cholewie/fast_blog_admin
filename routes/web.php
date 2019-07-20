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

Route::namespace('Admin')->group(
    function(){

        //登录部分
        Route::get('/login','SessionController@loginForm')->name('admin.login_form');
        Route::post('/login','SessionController@login')->name('admin.login');

        //忘记密码
        Route::post('/forget','SessionController@forget')->name('admin.forget');
        Route::get('/reset_view/{token}','SessionController@resetView')->name('admin.reset_view');
        Route::get('/reset','SessionController@reset')->name('admin.reset');
        Route::post('/reset_action','SessionController@resetAction')->name('admin.reset_action');

        //郵箱驗證
        Route::post('/signup','SessionController@signup')->name('admin.signup');
        Route::get('/signup/confirm/{token}','SessionController@confirmEmail')->name('admin.confirm_email');

        Route::middleware('admin')->group(function(){
            //后台首页部分
            Route::get('/admin/home','AdminController@home')->name('admin.home');

            //分类管理
            Route::get('/admin/category','CategoryController@cateList')->name('admin.category_list');
        });
    }
);
