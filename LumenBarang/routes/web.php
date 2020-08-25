<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});
$router->get('/all/product', 'Barang\BarangController@index');
$router->post('/product', 'Barang\BarangController@store');
$router->get('/product/{barang}', 'Barang\BarangController@show');
$router->put('/product/{barang}', 'Barang\BarangController@update');
$router->patch('/product/{barang}', 'Barang\BarangController@update');
$router->delete('/product/{barang}', 'Barang\BarangController@destroy');
