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

Route::get('contacts.getAll', 'ContactController@getAll');
Route::get('contacts.getByName', 'ContactController@getByName');
Route::post('contact.create', 'ContactController@create');
Route::put('contact.edit', 'ContactContrller@edit');
Route::delete('contact.delete', 'ContactController@delete');