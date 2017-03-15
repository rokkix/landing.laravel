<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group([], function () {
    Route::get('/', ['uses' => 'IndexController@index', 'as' => 'home']);
    Route::post('/', ['uses' => 'IndexController@sendMail', 'as' => 'mail']);
    Route::get('/page/{alias}', ['uses' => 'PageController@execute', 'as' => 'page']);
    Route::auth();
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        if (view()->exists('admin.index')) {
            $data = ['title' => 'Панель администратора'];
            return view('admin.index', $data);
        }

    });


    Route::group(['prefix' => 'pages'], function () {

        Route::get('/', ['uses' => 'admin\PagesController@index', 'as' => 'pages']);
        Route::get('/add', ['uses' => 'admin\PagesController@create', 'as' => 'pagesAdd']);
        Route::post('/add', ['uses' => 'admin\PagesController@store', 'as' => 'pagesStore']);
        Route::delete('/edit/{page}', ['uses' => 'admin\PagesController@destroy', 'as' => 'pagesDestroy']);
        Route::get('/edit/{page}', ['uses' => 'admin\PagesController@edit', 'as' => 'pagesEdit']);
        Route::patch('/edit/{page}', ['uses' => 'admin\PagesController@update', 'as' => 'pagesUpdate']);
     
    });


    Route::resource('/portfolios', 'admin\PortfolioController', ['except' => [
        'show'
    ]]);


    Route::group(['prefix' => 'services'], function () {
        Route::get('/', ['uses' => 'admin\ServiceController@index', 'as' => 'services']);
        Route::get('/add', ['uses' => 'admin\ServiceController@create', 'as' => 'servicesAdd']);
        Route::post('/add', ['uses' => 'admin\ServiceController@store', 'as' => 'servicesStore']);
        Route::get('/edit/{service}', ['uses' => 'admin\ServiceController@edit', 'as' => 'servicesEdit']);
        Route::patch('/edit/{service}', ['uses' => 'admin\ServiceController@update', 'as' => 'servicesUpdate']);
        Route::delete('/edit/{service}', ['uses' => 'admin\ServiceController@delete', 'as' => 'servicesDelete']);


    });


});

