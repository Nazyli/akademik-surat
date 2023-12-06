<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardNewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\FormTemplatesController;
use App\Http\Controllers\Admin\FormTypeController;
use App\Http\Controllers\Admin\PengajuanAdminController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\User\AkunController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\User\UserController;
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
    Route::get('home', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::resource('master/department', DepartmentController::class);
    Route::resource('master/program-studi', ProgramStudiController::class);
    Route::resource('master/tipe-borang', FormTypeController::class);
    Route::resource('master/jenis-borang', FormTemplatesController::class);
    Route::resource('master/berita-dashboard', DashboardNewsController::class);

    Route::get('pengajuan-surat', [PengajuanAdminController::class, 'index'])->name('pengajuanadmin.index');
    Route::get('pengajuan-surat/{id}', [PengajuanAdminController::class, 'edit'])->name('pengajuanadmin.preview');
    Route::put('pengajuan-surat/{id}', [PengajuanAdminController::class, 'update'])->name('pengajuanadmin.update');
    Route::get('/get-data-by-department/{departmentId}/{status}', [PengajuanAdminController::class, 'getByDepartmentId'])->name('getPengajuanByDepartmentId');
    Route::get('/api/getDataHome/{departmentId}', [AdminController::class, 'getDataHome'])->name('getDataHome');
});

Route::group(['namespace' => '', 'prefix' => 'user',  'middleware' => ['auth', 'is_user']], function () {
    Route::get('home', [UserController::class, 'userHome'])->name('user.home');
    Route::get('pengaturan-akun', [AkunController::class, 'index'])->name('pengaturan-akun.index');
    Route::put('pengaturan-akun/{id}', [AkunController::class, 'update'])->name('pengaturan-akun.update');
    Route::put('pengaturan-akun-updateImg/{id}', [AkunController::class, 'updateImg'])->name('pengaturan-akun-updateImg');

    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('getProgramStudi/{departmentId}', [PengajuanController::class, 'getProgramStudi'])->name('getProgramStudi');
    Route::post('pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');

    Route::get('riwayat', [PengajuanController::class, 'riwayat'])->name('pengajuan.riwayat');
    Route::get('riwayat/preview/{id}', [PengajuanController::class, 'preview'])->name('pengajuan.preview');
    Route::get('riwayat/edit/{id}', [PengajuanController::class, 'edit'])->name('pengajuan.edit');
    Route::put('riwayat/update/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    Route::get('riwayat/sent/{id}', [PengajuanController::class, 'sent'])->name('pengajuan.sent');
    Route::get('riwayat/cancel/{id}', [PengajuanController::class, 'cancel'])->name('pengajuan.cancel');

    Route::get('template-surat/{id}', [PengajuanController::class, 'templateSurat'])->name('templateSurat');
});
