<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index')->name('index');// what i see as a guest

Auth::routes();// routes that control all my authentication mechanism


// Route::get('/admin', 'HomeController@index')->name('admin'); old admin route

//grouped routes: middleware block everything before starting if not true, so have to stay before everything else, the prefix goes in the url so / -> /admin , namespace says laravel that we are looking into the admin folder
// in the end name is used to avoid writing everytime admmin in the route
Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin')
        ->group(function(){
            Route::get('/', 'HomeController@index')->name('index');
        });
