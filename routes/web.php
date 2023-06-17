<?php

use App\Http\Controllers\TaskController;
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

Route::get('/login', 'UserController@showLoginForm')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::post('/login', 'UserController@login');

Route::prefix('tasks')->group(function () {
    Route::get('/', 'TaskController@index')->name('tasks.index');
    Route::get('/create', 'TaskController@create')->name('tasks.create');
    Route::get('/{task}/edit', 'TaskController@edit')->name('tasks.edit');
    Route::delete('/{task}', 'TaskController@destroy')->name('tasks.destroy');
});

Route::middleware('auth')->prefix('tasks')->group(function () {
    Route::post('/', 'TaskController@store')->name('tasks.store');
    Route::put('/{task}', 'TaskController@update')->name('tasks.update');
});