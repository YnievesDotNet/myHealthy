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

/* Public Landing Page */
Route::get('/', ['as' => 'page.index', 'uses' => 'PagesController@index']);
Route::get('contact', ['as' => 'page.contact', 'uses' => 'PagesController@contact']);
Route::get('about', ['as' => 'page.about', 'uses' => 'PagesController@about']);

/* Public Language Switch */
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

/* Public Test Installer */
Route::get('installer', function () {
    Artisan::call('migrate:refresh', [
        '--seed' => true
    ]);
    echo "<pre>" . Artisan::output() . "</pre>";
});