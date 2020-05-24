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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('second')->with(['name'=>'karfrar','age'=>27]);
});

Route::resource('show','NewsController');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('redirect/{service}','socialController@redirect');
Route::get('callback/{service}','socialController@callback');
Route::get('offer','CrudController@getOffers');


    Route::group(['prefix'=> LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){
        Route::group(['prefix'=>'offers'],function(){
        Route::get('create','CrudController@create');
        Route::post('story','CrudController@story')->name('offers.story');
        Route::get('all','CrudController@getAllOffers');
    });


});

