<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Ahp\KriteriaController;
use App\Http\Controllers\petani\PetaniController;
use App\Http\Controllers\Ahp\AlternatifController;
use App\Http\Controllers\Ahp\SubKriteriaController;
use App\Http\Controllers\HasilPerhitunganController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\user\HistoryController as UserHistoryController;
use App\Http\Controllers\user\PilihanController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('login-proses', [AuthController::class, 'login_proses'])->name('login-proses');
    Route::get('/register', [AuthController::class, 'show'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile-foto/{user}', [ProfileController::class, 'foto'])->name('profile.foto');
    Route::put('profile-reset/{user}', [ProfileController::class, 'reset'])->name('profile.reset');

    Route::middleware(['userAkses:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.post');
        Route::put('/kriteria{id}', [KriteriaController::class, 'update'])->name('kriteria.put');
        Route::delete('/kriteria{id}', [KriteriaController::class, 'delete'])->name('kriteria.delete');
        Route::get('/kriteria-Matriks', [KriteriaController::class, 'matriks'])->name('kriteria.matriks');
        Route::post('/kriteria-Matriks/store', [KriteriaController::class, 'storeMatriks'])->name('kriteria.matriks.store');

        Route::get('/subKriteria{id}', [SubKriteriaController::class, 'index'])->name('subKriteria.index');
        Route::post('/subKriteria', [SubKriteriaController::class, 'store'])->name('subKriteria.post');
        Route::put('/subKriteria{id}', [SubKriteriaController::class, 'update'])->name('subKriteria.put');
        Route::delete('/subKriteria{id}', [SubKriteriaController::class, 'delete'])->name('subKriteria.delete');
        Route::get('/subKriteria{id}/matriks/go', [SubKriteriaController::class, 'matriks'])->name('matriks');
        Route::post('/subKriteria{id}/matriks/store/go', [SubKriteriaController::class, 'postMatriks'])->name('matriks.post');

        Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
        Route::post('/alternatif', [AlternatifController::class, 'store'])->name('alternatif.post');
        Route::put('/alternatif{id}', [AlternatifController::class, 'update'])->name('alternatif.put');
        Route::delete('/alternatif{id}', [AlternatifController::class, 'delete'])->name('alternatif.delete');
        Route::get('/penilaian-alternatif', [AlternatifController::class, 'tampilPenilaianAlternatif'])->name('alternatif.penilaian.form');
        Route::post('/penilaian-alternatif', [AlternatifController::class, 'simpanPenilaian'])->name('alternatif.penilaian.simpan');

        Route::get('HasilPerhitungan', [HasilPerhitunganController::class, 'index'])->name('hasil.index');

         Route::get('/admin/export-history-pdf', [PdfController::class, 'exportHistoryPdf'])
        ->name('admin.export.history.pdf');

    // Export PDF per user
    Route::get('/admin/export-history-pdf/{userId}', [PdfController::class, 'exportHistoryPdfByUser'])
        ->name('admin.export.history.user.pdf');

        Route::get('/management-account-admin', [AdminController::class, 'admin'])->name('akun.admin');
        Route::get('/management-account-user', [AdminController::class, 'user'])->name('akun.user');
        Route::post('/management-account', [AdminController::class, 'store'])->name('akun.store');
        Route::put('/management-account/{id}', [AdminController::class, 'update'])->name('akun.update');
        Route::delete('/management-account/{id}', [AdminController::class, 'destroy'])->name('akun.destroy');
    });

    Route::middleware(['userAkses:user'])->group(function () {
        Route::get('/welcome', [DashboardController::class, 'user'])->name('welcome');

        Route::get('/input-data', [PilihanController::class, 'inputData'])->name('inputData');
        Route::post('/simpan-data', [PilihanController::class, 'simpan'])->name('data.store');
        Route::get('/pilih', [PilihanController::class, 'pilih'])->name('data.pilih');
        Route::get('/history', [UserHistoryController::class, 'history'])->name('history');

        // Export PDF untuk user sendiri
        Route::get('/export-my-history-pdf', [PdfController::class, 'exportMyHistoryPdf'])
            ->name('user.export.history.pdf');

        // Export PDF hasil rekomendasi individual
        Route::get('/export-hasil-pdf/{id}', [PdfController::class, 'exportHasilPdf'])
            ->name('hasil.export');

        Route::get('/create akun', function () {
            return view('ahli.dashboard');
        });
    });
});

Route::get('/home', function () {
    return redirect('/dashboard');
});
