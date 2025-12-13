<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\petani\PetaniController;
use App\Http\Controllers\ahli\hama\KriteriaHamaController;
use App\Http\Controllers\ahli\hama\alternatifHamaController;
use App\Http\Controllers\ahli\hama\SubKriteriaHamaController;
use App\Http\Controllers\petani\PetaniPenyakitController as PetaniPetaniPenyakitController;


Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('login-proses', [AuthController::class, 'login_proses'])->name('login-proses');
    Route::get('/register', [AuthController::class, 'show'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');


    Route::middleware(['userAkses:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/kriteria', [KriteriaHamaController::class, 'index'])->name('kriteria.index');
        Route::post('/kriteria', [KriteriaHamaController::class, 'store'])->name('kriteria.post');
        Route::put('/kriteria{id}', [KriteriaHamaController::class, 'update'])->name('kriteria.put');
        Route::delete('/kriteria{id}', [KriteriaHamaController::class, 'delete'])->name('kriteria.delete');
        Route::get('/kriteria-Matriks', [KriteriaHamaController::class, 'matriks'])->name('kriteria.matriks');
        Route::post('/kriteria-Matriks/store', [KriteriaHamaController::class, 'storeMatriks'])->name('kriteria.matriks.store');

        Route::get('/subKriteria{id}', [SubKriteriaHamaController::class, 'index'])->name('subKriteria.index');
        Route::post('/subKriteria', [SubKriteriaHamaController::class, 'post'])->name('subKriteria.post');
        Route::put('/subKriteria{id}', [SubKriteriaHamaController::class, 'put'])->name('subKriteria.put');
        Route::delete('/subKriteria{id}', [SubKriteriaHamaController::class, 'delete'])->name('subKriteria.delete');
        Route::get('/subKriteria{id}/matriks/go', [SubKriteriaHamaController::class, 'matriks'])->name('matriks');
        Route::post('/subKriteria{id}/matriks/store/go', [SubKriteriaHamaController::class, 'postMatriks'])->name('matriks.post');

        Route::get('/alternatif', [alternatifHamaController::class, 'index'])->name('alternatif.index');
        Route::post('/alternatif', [alternatifHamaController::class, 'store'])->name('alternatif.post');
        Route::put('/alternatif{id}', [alternatifHamaController::class, 'update'])->name('alternatif.put');
        Route::delete('/alternatif{id}', [alternatifHamaController::class, 'delete'])->name('alternatif.delete');
        Route::get('/penilaian-alternatif', [AlternatifHamaController::class, 'tampilPenilaianAlternatif'])->name('alternatif.penilaian.form');
        Route::post('/penilaian-alternatif', [AlternatifHamaController::class, 'simpanPenilaian'])->name('alternatif.penilaian.simpan');

        Route::get('/', [AdminController::class, 'admin'])->name('admin.admin');
        Route::get('/user', [AdminController::class, 'user'])->name('admin.user');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

        // Buatkan route management account
        Route::get('/management-account', [AdminController::class, 'index'])->name('users.index');
        Route::post('/management-account', [AdminController::class, 'store'])->name('users.store');
        Route::put('/management-account/{id}', [AdminController::class, 'update'])->name('users.update');
        Route::delete('/management-account/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
    });




    // buatkan route middleware untuk users dan userAkses:admin
    Route::middleware(['userAkses:admin'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'admin'])->name('admin.admin');
        Route::get('/user', [AdminController::class, 'user'])->name('admin.user');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });

    Route::middleware(['userAkses:ahli'])->prefix('ahli')->group(function () {
        Route::get('/', [AdminController::class, 'ahli'])->name('adminA.index');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });



    Route::middleware(['auth', 'userAkses:petani'])->prefix('petani')->group(function () {
        Route::get('/dashboard/ku', function () {
            return view('petani.dashboard.index');
        })->name('dashboard.petani');

        Route::get('/input-gejala', [PetaniController::class, 'inputGejalaForm'])->name('petani.input.gejala');
        Route::post('/input-gejala', [PetaniController::class, 'simpanGejala'])->name('petani.input.gejala.hama.store');
        Route::get('/diagnosa', [PetaniController::class, 'diagnosa'])->name('petani.diagnosa');

        Route::get('/penyakit/history', [HistoryController::class, 'index'])->name('diagnosis.index');
        Route::get('/Hama/history', [HistoryController::class, 'hama'])->name('histori.hama');

        Route::get('/create akun', function () {
            return view('ahli.dashbo');
        });
    });
});
