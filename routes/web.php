<?php

use App\Http\Controllers\App\AppContoller;
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



Route::group([
    'middleware' => 'isLogin',
    'prefix' => '/'
], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::group([
    'prefix' => 'auth',
], function () {
    Route::get('/register', [AppContoller::class, 'register'])->name('register');
    Route::get('/login', [AppContoller::class, 'login'])->name('login');
});
