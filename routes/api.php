<?php

use Illuminate\Http\Request;

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

Route::get('contact.getList', 'ContactController@getList');
Route::get('contact.getByName', 'ContactController@getByName');
Route::post('contact.create', 'ContactController@create');
Route::put('contact.edit', 'ContactController@edit');
Route::delete('contact.delete', 'ContactController@delete');