<?php
// Filepath: routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MenuCycleController;
// Tambahkan Controller lain di sini saat sudah dibuat

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda mendaftarkan semua rute untuk aplikasi Anda.
|
*/

// Rute default, mengarahkan ke dashboard
Route::get('/', function () {
    // Nanti bisa diarahkan ke halaman login jika belum login
    return redirect()->route('dashboard');
});


// Asumsikan semua rute di bawah ini memerlukan login
// Route::middleware(['auth'])->group(function () {

    // Dashboard
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- GRUP OPERASIONAL ---
    Route::prefix('operasional')->name('operasional.')->group(function () {
        Route::get('/perencanaan-menu', [RecipeController::class, 'index'])->name('perencanaan.index');
        Route::resource('recipes', RecipeController::class)->except(['index']);
        Route::get('/siklus-menu', [MenuCycleController::class, 'index'])->name('siklus.index');
        Route::post('/siklus-menu', [MenuCycleController::class, 'save'])->name('siklus.save');
        // Perencanaan Menu

        // Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
        // Route::get('/produksi-stok', [ProduksiController::class, 'index'])->name('produksi.index');
        // Route::get('/distribusi', [DistribusiController::class, 'index'])->name('distribusi.index');
        // Route::get('/laporan-driver', [LaporanDriverController::class, 'index'])->name('laporan_driver.index');
    });

    // --- GRUP ADMINISTRASI ---
    Route::prefix('administrasi')->name('administrasi.')->group(function () {
        // Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
        // Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');
        // Route::get('/laporan-pengantaran', [LaporanPengantaranController::class, 'index'])->name('laporan_pengantaran.index');
    });

    // --- GRUP MANAJEMEN SDM ---
    Route::prefix('sdm')->name('sdm.')->group(function () {
        // Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
        // Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
        // Route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index');
    });

    // --- GRUP PENGATURAN / MASTER DATA ---
    Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
        // Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
        // Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
        // Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');
        // Route::get('/profil-yayasan', [ProfilController::class, 'yayasan'])->name('profil.yayasan');
        // Route::get('/profil-sppg', [ProfilController::class, 'sppg'])->name('profil.sppg');
    });

// }); // Akhir dari middleware group

