<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function(Request $request) {
    // dd($request->headers->get('auth'));
    // dd($request->headers->all());

    $response = new \Illuminate\Http\Response(json_encode(['message' => 'minha primeira resposta']));
    $response->header('Content-Type', 'application/json');
    return $response;
});

Route::namespace('App\Http\Controllers\Api')->group(function() {

    //Products Routes
    Route::prefix('products')->group(function() {
        Route::get('/', 'ProductController@index');
        Route::get('/{id}', 'ProductController@show');
        Route::post('/', 'ProductController@save');
        Route::put('/', 'ProductController@update');
        Route::patch('/', 'ProductController@update');
        Route::delete('/{id}', 'ProductController@delete');
    });

    Route::resource('/users', 'UserController');
});
