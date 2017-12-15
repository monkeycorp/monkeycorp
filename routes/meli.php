<?php

/**
 * Mercado Libre Routes
*/

Route::get('/', 'AuthController@index')
    ->name('meli.login');
Route::get('/auth', 'AuthController@auth');

Route::prefix('users')->group(function() {

    Route::get('me', 'UserController@me')
        ->name('meli.users.me');
    Route::get('me/update', 'UserController@editMe')
        ->name('meli.users.me.update');
    Route::post('me/update', 'UserController@updateMe')
        ->name('meli.users.me.update.post');
});