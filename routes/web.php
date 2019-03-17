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

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::match(['get', 'post'], 'password', 'UserController@password')->name("password");
    });

    // Route::middleware(['change.pw'])->group(function () {
        Route::get('', 'DashboardController@index')->name("dash");

        Route::group(['prefix' => 'members', 'as' => 'members.'], function () {
            Route::get('', 'MembersController@index')->name("list");
            // Route::get('get', 'MembersController@tableData')->name("get");
        });

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::match(['get', 'post'], 'password', 'UserController@password')->name("password");
        });

        Route::group(['prefix' => 'gyms', 'as' => 'gyms.'], function () {
            Route::get('{gym}/delete', 'GymController@delete')->name("delete");
            Route::get('', 'GymController@index')->name("list");
            Route::get('new', 'GymController@add')->name("new");
            Route::post('new', 'GymController@store')->name("new");
            Route::get('{gym}', 'GymController@view')->name("view");
            Route::match(["get", "post"], '{gym}/edit', 'GymController@edit')->name("edit");
            route::get('{gym}/trainer', 'PTController@new')->name("trainer");
            route::post('{gym}/trainer', 'PTController@new')->name("trainer")->middleware('optimizeImages');
            route::get('{gym}/member', 'GymController@newMember')->name("member");
            route::post('{gym}/member', 'GymController@newMember')->name("member")->middleware('optimizeImages');
            Route::match(["get", "post"], '{gym}/member/{member}/edit', 'GymController@editMember')->name("member.edit");
            Route::get('{gym}/member/{member}/delete', 'GymController@deleteMember')->name("member.delete");
            Route::match(["get", "post"], "{gym}/classes/{class?}", 'GymController@classes')->name('classes');
            route::post("{gym}/classes/delete/{class?}", 'GymController@deleteClass')->name("classes.delete");
        });

        Route::group(['prefix' => 'pt', 'as' => 'pt.'], function () {
            Route::get('{pt}', 'PTController@view')->name("view");
            Route::get('{pt}/delete', 'PTController@delete')->name("delete");
            Route::get('{pt}/toggle', 'PTController@toggle')->name("toggle");
            Route::match(["get", "post"], '{pt}/edit', 'PTController@edit')->name("edit");

            Route::match(["get", "post"], "{pt}/availability/{availability?}", 'PTController@availability')->name('availability');
            Route::get("{pt}/calendar", 'PTController@cal')->name('cal');

            Route::post("{pt}/session", 'PTController@session')->name('session');
            Route::post("{pt}/session/{session?}/edit", 'PTController@editSession')->name('session.edit');
            Route::post("{pt}/session/{session?}", 'PTController@changeSession')->name('session.change');
            Route::post("{pt}/session/complete/{session?}", 'PTController@completeSession')->name('session.complete');
            Route::post("{pt}/removeSession/{session?}", 'PTController@removeSession')->name('session.remove');
        });

        // Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
        //     Route::get('{user?}', 'ClientController@view')->name("view");
        // });

        // Admin
        Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::get('', 'AdminController@index')->name("dash");
            Route::get('users', 'AdminController@users')->name("users");
            Route::get('users/{user}', 'AdminController@edit')->name("users.edit");
            Route::post('users/{user}', 'AdminController@update');
        });
    // });
});

// Route::get('/home', 'HomeController@index')->name('home');
