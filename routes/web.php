<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth','prefix'=>'/'],function()
{
    /*Dashboard Routes*/
    Route::group(['prefix' => 'dashboard','namespace'=>'Dashboard'],function(){
        Route::get('/', 'DashboardController@index')->name('dashboard');
    });

    /*Users Routes*/
    Route::group(['prefix' => 'users','namespace'=>'Users'],function(){

        Route::get('/', 'UsersController@index')->name('users');
        Route::get('/create', 'UsersController@create')->name('users.create');
        Route::post('/store', 'UsersController@store')->name('users.store');
        Route::get('/edit', 'UsersController@edit')->name('users.edit');
        Route::match(['PUT','PATCH'],'/update', 'UsersController@update')->name('users.update');
        Route::get('/destroy', 'UsersController@destroy')->name('users.destroy');
        Route::get('/show', 'UsersController@show')->name('users.show');
        Route::get('/showUsers', 'UsersController@showUsers')->name('users.showUsers');

        /*Roles Routes*/
        Route::group(['prefix' => 'roles','namespace'=>'Roles'],function(){
            Route::get('/edit', 'RolesController@edit')->name('users.roles.edit');
            Route::post('/update', 'RolesController@update')->name('users.roles.update');
        });

    });

    // End Users Routes
    Route::group(['prefix' => 'endusers', 'namespace' => 'EndUsers'],function(){
        Route::get('/','EndUsersController@index')->name('endusers');
        Route::get('create','EndUsersController@create')->name('endusers.create');
        Route::post('store','EndUsersController@store')->name('endusers.store');
        Route::get('edit','EndUsersController@edit')->name('endusers.edit');
        Route::put('update','EndUsersController@update')->name('endusers.update');
        Route::get('destroy','EndUsersController@destroy')->name('endusers.destroy');
        Route::get('showUsers','EndUsersController@showUsers')->name('endusers.showUsers');

    });


    //User Types
    Route::group(['prefix' => 'usertypes', 'namespace' => 'UserTypes'],function(){
        Route::get('/','UserTypesController@index')->name('usertypes');
        Route::get('showUserType','UserTypesController@showUserType')->name('usertypes.showUserType');
        Route::get('roles','UserTypesController@roles')->name('usertypes.roles');
        Route::post('roles/update','UserTypesController@update')->name('usertypes.roles.update');

    });

    /*Events Controller*/
    Route::group(['prefix' => 'events','namespace'=>'Events'],function(){
        Route::get('/', 'EventsController@index')->name('event');
        Route::get('/create', 'EventsController@create')->name('event.create');
        Route::post('/store', 'EventsController@store')->name('event.store');
        Route::get('/edit', 'EventsController@edit')->name('event.edit');
        Route::match(['PUT','PATCH'],'/update', 'EventsController@update')->name('event.update');
        Route::get('/destroy', 'EventsController@destroy')->name('event.destroy');
        Route::get('/showEvents', 'EventsController@showEvents')->name('event.showEvents');
        Route::get('calendar','EventsController@calendar')->name('calendar');

    });

});
