<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::view('/forbidden', '400');

Auth::routes();
// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::group(['namespace' => '', 'prefix' => 'admin',  'middleware' => ['auth', 'is_admin']], function () {
    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');
});

Route::group(['namespace' => '', 'prefix' => 'user',  'middleware' => ['auth', 'is_user']], function () {
    Route::get('home', [HomeController::class, 'userHome'])->name('user.home');
});
