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
// $router->get('/all/barang', 'Barang\BarangController@index');
$router->post('/order', 'Order\OrderController@order');
// $router->get('/barang/{barang}', 'Barang\BarangController@show');
// $router->put('/barang/{barang}', 'Barang\BarangController@update');
// $router->patch('/barang/{barang}', 'Barang\BarangController@update');
// $router->delete('/barang/{barang}', 'Barang\BarangController@destroy');
