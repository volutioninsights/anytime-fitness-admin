<?php

use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */


Route::group(['namespace' => 'api', 'middleware' => 'auth:api'], function () {

    Route::group(['prefix' => 'trainer', 'as' => 'trainer.'], function () {
        Route::get('clients', 'TrainerController@clients');

    });

    Route::group(['middleware' => 'talk', 'prefix' => 'msg', 'as' => 'msg.'], function () {
        Route::get('thread/{thread}', 'MessagingController@thread');
        Route::post('send', 'MessagingController@send');
        Route::post('create', 'MessagingController@create');
        Route::get('inbox', 'MessagingController@inbox');
    });

    Route::get('me', function () {
        return response()->json(Auth::user());
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
