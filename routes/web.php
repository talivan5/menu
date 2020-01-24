<?php

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

Route::get('/', function () {
    return view('inicio');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('notes', 'NotesController@index');

Route::get('notes/{id}/destroy', 'NotesController@destroy')->name('notes.destroy');

Route::get('roles','RolController@listar')->name('roles.index');

Route::get('permisos','PermisoController@listar')->name('permiso.index');

Route::get('menus','MenuController@listar')->name('menus.index');
Route::get('ordenmenus','OrdenMenuController@listar');

Route::get('bitacoras','UserSystemInfoController@listar')->name('bitacora.index');

