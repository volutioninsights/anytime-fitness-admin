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
Auth::routes();

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api', 'as' => 'api::'], function () {

    Route::group(['prefix' => 'trainer', 'as' => 'trainer.'], function () {
        Route::get('clients', 'TrainerController@clients');
        Route::get('{user?}', function (User $user = null) {
            return response()->json(is_null($user) ? Auth::user() : $user);
        });
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
});
