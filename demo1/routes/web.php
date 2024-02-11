<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/index.js', function () {
    return file_get_contents('resources/js/index');
});

Route::get('/action_performed', function () {
    return file_get_contents('action_performed');
});

Route::get('/user_page', function () {
    return view('user_page');
});

Route::get('/signup', function () {
    return view('signup');
});