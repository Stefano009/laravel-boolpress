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

//rotta per la pagina profilo

// rotta non protetta app_id
Route::resource('/posts', 'PostController');
Route::get('/vue-posts', 'HomeController@listPostsApi')->name('list-posts-api');

Auth::routes();// routes that control all my authentication mechanism


// Route::get('/admin', 'HomeController@index')->name('admin'); old admin route
//routes for the emails
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@handleContactForm')->name('contact.send');
Route::get('/thank-you', 'HomeController@thankYou')->name('contact.thank-you');

//grouped routes: middleware block everything before starting if not true, so have to stay before everything else, the prefix goes in the url so / -> /admin , namespace says laravel that we are looking into the admin folder
// in the end name is used to avoid writing everytime admmin in the route
Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')
->group(function(){
    Route::get('/', 'AdminController@index')->name('index');

    Route::resource('/posts', 'PostController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');

    // rotte pagina profilo
    Route::get('profile', 'HomeController@profile')->name('profile');   
    Route::post('generate_token', 'HomeController@generateToken')->name('generate_token');   

});