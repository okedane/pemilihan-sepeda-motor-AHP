<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\petani\PetaniController;
use App\Http\Controllers\Ahp\AlternatifController;
use App\Http\Controllers\Ahp\KriteriaController;
use App\Http\Controllers\Ahp\SubKriteriaController;

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

        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.post');
        Route::put('/kriteria{id}', [KriteriaController::class, 'update'])->name('kriteria.put');
        Route::delete('/kriteria{id}', [KriteriaController::class, 'delete'])->name('kriteria.delete');
        Route::get('/kriteria-Matriks', [KriteriaController::class, 'matriks'])->name('kriteria.matriks');
        Route::post('/kriteria-Matriks/store', [KriteriaController::class, 'storeMatriks'])->name('kriteria.matriks.store');

        Route::get('/subKriteria{id}', [SubKriteriaController::class, 'index'])->name('subKriteria.index');
        Route::post('/subKriteria', [SubKriteriaController::class, 'post'])->name('subKriteria.post');
        Route::put('/subKriteria{id}', [SubKriteriaController::class, 'put'])->name('subKriteria.put');
        Route::delete('/subKriteria{id}', [SubKriteriaController::class, 'delete'])->name('subKriteria.delete');
        Route::get('/subKriteria{id}/matriks/go', [SubKriteriaController::class, 'matriks'])->name('matriks');
        Route::post('/subKriteria{id}/matriks/store/go', [SubKriteriaController::class, 'postMatriks'])->name('matriks.post');

        Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
        Route::post('/alternatif', [AlternatifController::class, 'store'])->name('alternatif.post');
        Route::put('/alternatif{id}', [AlternatifController::class, 'update'])->name('alternatif.put');
        Route::delete('/alternatif{id}', [AlternatifController::class, 'delete'])->name('alternatif.delete');
        Route::get('/penilaian-alternatif', [AlternatifController::class, 'tampilPenilaianAlternatif'])->name('alternatif.penilaian.form');
        Route::post('/penilaian-alternatif', [AlternatifController::class, 'simpanPenilaian'])->name('alternatif.penilaian.simpan');



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
