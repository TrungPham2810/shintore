<?php
use Illuminate\Support\Facades\Route;
/**
 * Created by PhpStorm.
 * User: Trung Pham
 * Date: 1/12/2021
 * Time: 12:14 AM
 */

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin');
//    Route::get('/', [
//            'as'=> 'admin',
//            'uses' =>'Admin\DasboardController@showLoginForm '
//        ]
//    );

//    Route::get('/login', function () {
//        return view('auth.login');
//    });

//    Route::get('/login', function () {
//        return view('auth.login');
//    })->name('admin_login');

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [
                'as'=> 'admin.categories.index',
                'uses' =>'Admin\CategoryController@index',
                'middleware'=>'can:list_category'
            ]
        );
        Route::get('/create', [
                'as'=> 'admin.categories.create',
                'uses' =>'Admin\CategoryController@create',
                'middleware'=>'can:add_category'
            ]
        );
        Route::post('/store', [
                'as'=> 'admin.categories.store',
                'uses' =>'Admin\CategoryController@store',
                'middleware'=>'can:add_category'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'admin.categories.edit',
                'uses' =>'Admin\CategoryController@edit',
                'middleware'=>'can:edit_category'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'admin.categories.update',
                'uses' =>'Admin\CategoryController@update',
                'middleware'=>'can:edit_category'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'admin.categories.delete',
                'uses' =>'Admin\CategoryController@delete',
            ]
        );
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [
                'as'=> 'admin.product.index',
                'uses' =>'Admin\ProductController@index',
                'middleware'=>'can:list_product'
            ]
        );
        Route::get('/create', [
                'as'=> 'admin.product.create',
                'uses' =>'Admin\ProductController@create',
                'middleware'=>'can:create_product'
            ]
        );
        Route::post('/store', [
                'as'=> 'admin.product.store',
                'uses' =>'Admin\ProductController@store',
                'middleware'=>'can:create_product'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'admin.product.edit',
                'uses' =>'Admin\ProductController@edit',
                'middleware'=>'can:edit_product'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'admin.product.update',
                'uses' =>'Admin\ProductController@update',
                'middleware'=>'can:edit_product'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'admin.product.delete',
                'uses' =>'Admin\ProductController@delete'
            ]
        );
    });

    Route::group(['prefix' => 'importdata'], function () {
        Route::get('/', [
                'as'=> 'admin.importdata.index',
                'uses' =>'Admin\ImportDataController@index',
//                'middleware'=>'can:list_category'
            ]
        );

        Route::post('/store', [
                'as'=> 'admin.importdata.import',
                'uses' =>'Admin\ImportDataController@importdata',
//                'middleware'=>'can:add_category'
            ]
        );
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [
                'as'=> 'admin.user.index',
                'uses' =>'Admin\UserController@index',
                'middleware'=>'can:list_user'
            ]
        );
        Route::get('/create', [
                'as'=> 'admin.user.create',
                'uses' =>'Admin\UserController@create',
                'middleware'=>'can:create_user'
            ]
        );
        Route::post('/store', [
                'as'=> 'admin.user.store',
                'uses' =>'Admin\UserController@store',
                'middleware'=>'can:create_user'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'admin.user.edit',
                'uses' =>'Admin\UserController@edit',
                'middleware'=>'can:edit_user'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'admin.user.update',
                'uses' =>'Admin\UserController@update',
                'middleware'=>'can:edit_user'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'admin.user.delete',
                'uses' =>'Admin\UserController@delete'
            ]
        );
    });

    Route::group(['prefix' => 'rule'], function () {
        Route::get('/', [
                'as'=> 'admin.rule.index',
                'uses' =>'Admin\RuleController@index',
                'middleware'=>'can:list_rule'
            ]
        );
        Route::get('/create', [
                'as'=> 'admin.rule.create',
                'uses' =>'Admin\RuleController@create',
                'middleware'=>'can:create_rule'
            ]
        );
        Route::post('/store', [
                'as'=> 'admin.rule.store',
                'uses' =>'Admin\RuleController@store',
                'middleware'=>'can:create_rule'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'admin.rule.edit',
                'uses' =>'Admin\RuleController@edit',
                'middleware'=>'can:edit_rule'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'admin.rule.update',
                'uses' =>'Admin\RuleController@update',
                'middleware'=>'can:edit_rule'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'admin.rule.delete',
                'uses' =>'Admin\RuleController@delete'
            ]
        );
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [
                'as'=> 'admin.role.index',
                'uses' =>'Admin\RoleController@index',
                'middleware'=>'can:list_role'
            ]
        );
        Route::get('/create', [
                'as'=> 'admin.role.create',
                'uses' =>'Admin\RoleController@create',
                'middleware'=>'can:create_role'
            ]
        );
        Route::post('/store', [
                'as'=> 'admin.role.store',
                'uses' =>'Admin\RoleController@store',
                'middleware'=>'can:create_role'
            ]
        );
        Route::get('/edit/{id}', [
                'as'=> 'admin.role.edit',
                'uses' =>'Admin\RoleController@edit',
                'middleware'=>'can:edit_role'
            ]
        );
        Route::post('/update/{id}', [
                'as'=> 'admin.role.update',
                'uses' =>'Admin\RoleController@update',
                'middleware'=>'can:edit_role'
            ]
        );

        Route::get('/delete/{id}', [
                'as'=> 'admin.role.delete',
                'uses' =>'Admin\RoleController@delete'
            ]
        );
    });
});
