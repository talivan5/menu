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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('roles','RolController',['except' => ['edit', 'create']]);
Route::resource('permisos','PermisoController',['except' => ['edit', 'create']]);
Route::resource('menus','MenuController',['except' => ['edit', 'create']]);
Route::resource('ordenmenus','OrdenMenuController',['except' => ['edit', 'create']]);

Route::resource('bitacoras','UserSystemInfoController',['except' => ['edit', 'create']]);



