<?php

use App\Http\Controllers\Admin\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Siswa\siswaController;

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

// Route::get('/', function () {
//     return view('layouts.main');
// });
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'is_admin'], function () {
    //Halman setelah login admin
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    //melihat list daftar calon siswa
    Route::get('daftar_pendaftar', [adminController::class, 'dataPendaftar']);
    Route::post('list_calon', [adminController::class, 'dataCalon']);
    // Memverifikasi Data
    Route::post('update_status', [adminController::class, 'update']);
    Route::post('update_verif', [adminController::class, 'verif']);
    // Menerima, Cadangan, Tolak Siswa
    Route::post('status_terima', [adminController::class, 'status']);
});

Route::group(['middleware' => 'is_siswa'], function () {
    Route::get('siswa/home', [HomeController::class, 'siswaHome'])->name('siswa.home');
    Route::get('pendaftaran_siswa', [siswaController::class, 'index']);
    Route::get('pendaftaran_siswa_sudahkirim/{id}', [siswaController::class, 'sudahDaftar']);
    Route::post('biodata_siswa', [siswaController::class, 'addBiodata']);
    Route::post('daftarkan', [siswaController::class, 'daftarkan']);
});
