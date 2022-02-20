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


Route::get('/', fn()  => view('welcome'));

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contact', 'ContactController')->except(['show']);
    Route::get('/settings', 'SettingsController@edit')->name('settings');
    Route::patch('/settings', 'SettingsController@update')->name('settings-update');
});

