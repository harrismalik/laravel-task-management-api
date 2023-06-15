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

Route::prefix('tasks')->group(function () {
    Route::get('/', 'TaskController@index')->name('tasks.index');
    Route::get('/create', 'TaskController@create')->name('tasks.create');
    Route::post('/', 'TaskController@store')->name('tasks.store');
    Route::get('/{task}/edit', 'TaskController@edit')->name('tasks.edit');
    Route::put('/{task}', 'TaskController@update')->name('tasks.update');
    Route::delete('/{task}', 'TaskController@destroy')->name('tasks.destroy');
});