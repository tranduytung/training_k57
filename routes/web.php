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
    return view('welcome');
});

Route::get('/p/{slug}', function ($slug) {
    $view = str_replace('-','_', (string)$slug);
    if (file_exists(resource_path("/views/pages/{$view}.blade.php"))) {
        return view("pages.{$view}");
    }

    return abort(404, 'Resource not found');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
