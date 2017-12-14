<?php

/**
 * Mercado Libre Routes
*/

Route::get('/', 'AuthController@index')
    ->name('LoginMercadoLibre');
Route::get('/auth', 'AuthController@auth');

Route::prefix('users')->group(function() {

    Route::get('me', 'UserController@me');
});