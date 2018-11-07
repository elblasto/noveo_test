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
Route::model('user', 'App\Models\User');
Route::model('group', 'App\Models\Group');

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'users',
    'as'     => 'users::',
], function () {
    Route::get('/', ['uses' => 'UserController@listAction', 'as' => 'list']);
    Route::get('/create', ['uses' => 'UserController@createAction', 'as' => 'create']);
    Route::get('/{user}', ['uses' => 'UserController@editAction', 'as' => 'edit']);
    Route::post('/{user?}', ['uses' => 'UserController@storeAction', 'as' => 'store']);
});

Route::group([
    'prefix' => 'groups',
    'as'     => 'groups::',
], function () {
    Route::get('/', ['uses' => 'GroupController@listAction', 'as' => 'list']);
    Route::get('/create', ['uses' => 'GroupController@createAction', 'as' => 'create']);
    Route::get('/{group}', ['uses' => 'GroupController@editAction', 'as' => 'edit']);
    Route::get('/{group}/users', ['uses' => 'GroupController@usersListAction', 'as' => 'usersList']);
    Route::post('/{group}/users', ['uses' => 'GroupController@usersListStoreAction', 'as' => 'usersListStore']);
    Route::post('/{group?}', ['uses' => 'GroupController@storeAction', 'as' => 'store']);
});
